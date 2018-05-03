<!DOCTYPE html>

<html>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
 	<meta name="robots" content="noindex">
    <title>Image Gallery</title>
    <? include("globals.inc.php"); ?>
    <? if(!$build) { ?>
	<script src="upload.js"></script>
    <? } ?>
    
    <link rel="stylesheet" type="text/css" href="<?= $root_path ?>blender.css" />

<?
	$page = isset($_GET['page']) ? $_GET['page'] : 0;
	
	$thumbsOffset = $page * $usualNumberOfThumbs;
	
	$numberOfThumbs = $totalNumberOfFiles - $thumbsOffset >= $usualNumberOfThumbs ? $usualNumberOfThumbs : $totalNumberOfFiles - $thumbsOffset;
	
	$thumbnailCollumns = ceil(sqrt($numberOfThumbs));
	$thumbnailRows = $thumbnailCollumns;
	
	$nextOffset = $thumbsOffset +  $numberOfThumbs < $totalNumberOfFiles ? $thumbsOffset +  $numberOfThumbs : 0;
	$previousOffset = $thumbsOffset < $usualNumberOfThumbs ? $totalNumberOfFiles - $totalNumberOfFiles % $usualNumberOfThumbs : $thumbsOffset - $usualNumberOfThumbs;
	$previousOffset = $previousOffset == $totalNumberOfFiles ? $previousOffset - $usualNumberOfThumbs : $previousOffset;
	
	$nextPage = $nextOffset / $usualNumberOfThumbs;
	$previousPage = $previousOffset / $usualNumberOfThumbs;
	$previousPage = $previousPage > 0 ? $previousPage : 0;
?>

<body <? if(!$build) { ?>onload="init();"<? } ?>>

<?
include("header.html.php");
?>

<table>
<tr>

<td>
<a href="<?= indexLink($previousPage) ?>"><img src="<?= $root_path ?>previous-image.png"></a>
</td>

<td id="thumbs">

	<div>
    <?
	for($i = 0; $i < $thumbnailRows; $i++) {
	?>
    <div>
    <?
	for($j = 0; $j < $thumbnailCollumns; $j++) {
	if($numberOfThumbs > $i * $thumbnailCollumns + $j) {
		$file_parts = parseFileName($files[$i * $thumbnailCollumns + $j + $thumbsOffset]);
		
		$thumbnail = $root_path . 'thumbs/thumb.' . $file_parts["prefix"] . '.' . $file_parts["topic"] . '.' . $file_parts["title"] . '.' . $file_parts["extension"];
	?>
     
    <a href="<?= imageLink($file_parts["prefix"]) ?>"><img src="<?= $thumbnail ?>" /></a>
    <?
	}}
    ?>
    </div>
    <?
	}
    ?>
	</div>
    
</td>

<td>
<a href="<?= indexLink($nextPage) ?>"><img src="<?= $root_path ?>next-image.png"></a>
</td>

</tr>
</table>

</body>
</html>