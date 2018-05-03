<?
function logged() {
	$storedUser = isset($_COOKIE['user']) ? $_COOKIE['user'] : '';
    $storedPassword = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
	
	if($storedUser == "resu" && $storedPassword == "sapp") {
		return(true);
	} else {
		return(false);
	}
}

function parseFileName($fileName) {
	$fileName = substr($fileName, 3);
	$fileParts = explode('.', $fileName);
	$part_0_array = explode('/', $fileParts[0]);
	
	return(array("number" => ltrim($part_0_array[1], "0"), "prefix" => $part_0_array[1], "topic" => $fileParts[1], "title" => $fileParts[2], "extension" => $fileParts[3]));
}

function parsedFileName($prefix) {
	$files = glob("../images/" . formatPrefix($prefix) . "*.*");
	return(parseFileName($files[0]));
}

function formatPrefix($rawPrefix) {
	return(str_pad($rawPrefix, 4, "0", STR_PAD_LEFT));
}

function createPage($page, $url) {
	
	$fullURL = $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
	$fullURL = "http://" . substr($fullURL, 0, strrpos($fullURL, "/edit/")) . "/edit/" . $url . "&build";
	
	$html = file($fullURL);
	
	$file_pointer = fopen($page, 'w');
					
	foreach($html as $line)
	{
			fwrite($file_pointer, $line);
	}
	
	fclose($file_pointer);
}

function format($string) {
	$string = htmlentities($string); 
	$string = trim($string);
	$string = str_replace(' ', '-', $string);
	return($string);
}

function zeroPad($number) {
	return(str_pad($number, 4, "0", STR_PAD_LEFT));
}

function imageFileName($prefix) {
	$fileParts = parsedFileName($prefix);
	return($fileParts["topic"] . "." . $fileParts["title"] . ".html");
}

function imageLink($prefix) {
	global $build;
	if(!$build) {
		return("image.php?prefix=" . $prefix);
	} else {
		return(imageFileName($prefix));
	}
}

function indexFileName($page) {
	return("page-" . str_pad($page, 4, "0", STR_PAD_LEFT) . ".html");
}

function indexLink($page) {
	global $build;
	if(!$build) {
		return("index.php?page=" . $page);
	} else {
		return(indexFileName($page));
	}
}
	
$build = isset($_GET["build"]);

$folder_depth = substr_count($_SERVER["PHP_SELF"], "/", strpos($_SERVER["PHP_SELF"], ".com")) - 1;

$root_path = "./";
if($folder_depth > 0) {
	$root_path = "";
for($index = 0; $index < $folder_depth; $index++)
    $root_path .= "../";
}

$root_path = $build ? "./" : "../";

$thumbnailWidth = 100;
$thumbnailHeight = 100;
$usualNumberOfThumbs = 25;
$valid_extensions = Array('jpg', 'gif', 'png');
$build = isset($_GET['build']);
	
$pattern = '../images/*.{' . implode(',', $valid_extensions) . '}';
$files = glob($pattern, GLOB_BRACE);
sort($files);
$totalNumberOfFiles = count($files);
?>