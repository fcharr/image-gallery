<?
include_once('globals.inc.php');

function imageContents($blob) {
	$blob = substr($blob, strpos($blob, ",") + 1);
	$blob = base64_decode($blob);
	
	return($blob);
}

function getImageResource($uploadedFile, $extension) {
	switch($extension) {
		case 'png':
			return(imageCreateFromPNG($uploadedFile));
			break;
		case 'jpg':
			return(imageCreateFromJPEG($uploadedFile));
			break;
		case 'gif':
			return(imageCreateFromGIF($uploadedFile));
			break;
	}
	
	return(null);
}

if(logged()) {
	$prefix = $_POST["prefix"];
	$topic = $_POST["topic"];
	$title = $_POST["title"];
	$extension = $_POST["extension"];
	$reader = $_POST["reader"] != "null" ? imageContents($_POST["reader"]) : null;
	
	if(!file_exists('../images')) {
		mkdir('../images', 0777, true);
	}
	
	if(!file_exists('../thumbs')) {
		mkdir('../thumbs', 0777, true);
	}
	
	$imageFile = "../images/" . zeroPad($prefix) . "." . str_replace(" ", "-", $topic) . "." . str_replace(" ", "-", $title) . "." . $extension;
	$thumbFile = "../thumbs/thumb." . zeroPad($prefix) . "." . str_replace(" ", "-", $topic) . "." . str_replace(" ", "-", $title) . "." . $extension;
	
	$oldFile = glob("../images/" . $prefix . "*.*");
	if(sizeof($oldFile) == 1) {
		$oldHTMLFile = imageFileName($prefix);
		rename($oldFile[0], $imageFile);
		rename("../" . $oldHTMLFile, "../" . imageFileName($prefix));
	}
	
	$oldThumb = glob("../thumbs/thumb." . $prefix . "*.*");
	if(sizeof($oldThumb) == 1) {
		rename($oldThumb[0], $thumbFile);
	}
	
	if($reader != null) {
		file_put_contents($imageFile, $reader);
		
		$imageSize = getImageSize($imageFile);
		$imageWidth = $imageSize[0];
		$imageHeight = $imageSize[1];
		
		$image = getImageResource($imageFile, $extension);
		
		$thumbnail = imageCreateTrueColor($thumbnailWidth, $thumbnailHeight);
		
		imageCopy($thumbnail, $image, 0, 0, ($imageWidth - $thumbnailWidth) / 2, ($imageHeight - $thumbnailHeight) / 2, $thumbnailWidth, $thumbnailHeight);
		
		imagepng($thumbnail, $thumbFile);
	}
?>
buildImagePage(<?= str_pad(ltrim($prefix, "0"), 1, "0", STR_PAD_LEFT) ?>, false);
<? } ?>

