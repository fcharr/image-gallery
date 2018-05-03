<?
include_once('globals.inc.php');

if(logged()) {
	$page = isset($_POST["page"]) ? $_POST["page"] : null;
	$nextPage = null;
	
	$prefix = isset($_POST["prefix"]) ? $_POST["prefix"] : null;
	$nextPrefix = null;
	
	$all = isset($_POST["all"]) ? true : false;
	
	if($prefix !== null) {
		createPage("../" . imageFileName($prefix), "image.php?prefix=" . $prefix);
		
		$previousPrefix = $prefix - 1 > 0 ? $prefix - 1 : $totalNumberOfFiles -1;
		$nextPrefix = ($prefix + 1) % $totalNumberOfFiles;
		
		if(!$all) {
			createPage("../" . imageFileName($previousPrefix), "image.php?prefix=" . $previousPrefix);
			createPage("../" . imageFileName($nextPrefix), "image.php?prefix=" . $nextPrefix);
			
			$page = ($prefix - $prefix % $usualNumberOfThumbs) / $usualNumberOfThumbs;
		}
	}
	
	if($page !== null) {
		createPage("../" . indexFileName($page), "index.php?page=" . $page);
		
		$nextPage = $page + 1;
	}
?>
<? if($prefix != null && $all && $prefix < $totalNumberOfFiles - 1) { ?>
buildImagePage(<?= $nextPrefix ?>, true);
console.log("prefix <?= $nextPrefix ?>");
<? } ?>

<? if($prefix != null && $all && $prefix == $totalNumberOfFiles - 1) { ?>
buildThumbnailPage(0, true);
console.log("page Zero");
<? } ?>

<? if($page != null && $all && $page < $totalNumberOfFiles / $usualNumberOfThumbs) { ?>
buildThumbnailPage(<?= $nextPage ?>, true);
console.log("page <?= $nextPage ?>");
<? } ?>

<? if(!$all && $prefix != null) { ?>
window.open('../<?= imageFileName($prefix) ?>', '_newtab');
document.location = './index.php?page=<?= $page ?>';
<? } ?>
<? } ?>
