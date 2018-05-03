<!DOCTYPE html>

<?
include("globals.inc.php");

$prefix = isset($_GET["prefix"]) ? $_GET["prefix"] : 0;

$file_parts = parsedFileName($prefix);

$previousPrefix = $prefix  > 0 ? $prefix - 1 : $totalNumberOfFiles - 1;
$previousPrefix = formatPrefix($previousPrefix);

$nextPrefix = ($prefix + 1) % $totalNumberOfFiles;
$nextPrefix = formatPrefix($nextPrefix);

$page = ($prefix - $prefix % $usualNumberOfThumbs) / $usualNumberOfThumbs;
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= str_replace("-", " ", $file_parts["topic"]) ?> :: <?= str_replace("-", " ", $file_parts["title"]) ?></title>

<? if(!$build) { ?>
<script src="upload.js"></script>
<? } ?>

<link rel="stylesheet" type="text/css" href="<?= $root_path ?>blender.css" />
</head>

<body <? if(!$build) { ?>onload="init();"<? } ?>>

<?
include("header.html.php");
?>

<table>
<? if(!$build && logged()) { ?>
<tr>
    <td colspan="3">
    <input  type="file" id="upload" onChange="preview();" />
    <input type="text" id="topic" value="<?= str_replace("-", " ", $file_parts["topic"]) ?>" />
    <input type="text" id="title" value="<?= str_replace("-", " ", $file_parts["title"]) ?>" />
    <input type="hidden" id="prefix" value="<?= $prefix ?>" />
    <input type="button" onClick="uploadImage();" value="save" />
    <input type="button" onClick="buildImagePage(<?= str_pad(ltrim($prefix, "0"), 1, "0", STR_PAD_LEFT) ?>, false);" value="build" />
    </td>
</tr>
<? } ?>

<tr>

    <td>
    <a href="<?= imageLink($previousPrefix) ?>"><img src="<?= $root_path ?>previous-image.png"></a>
    </td>
    
    <td>
    <a href="<?= indexLink($page) ?>">
    <img id="image" src="<?= $root_path ?>images/<?= $file_parts["prefix"] ?>.<?= $file_parts["topic"] ?>.<?= $file_parts["title"] ?>.<?= $file_parts["extension"] ?>" /></a>
    </td>
    
    <td>
    <a href="<?= imageLink($nextPrefix) ?>"><img src="<?= $root_path ?>next-image.png"></a>
    </td>
    
</tr>

<tr>
    <td colspan="3">
    <h1><?= str_replace("-", " ", $file_parts["topic"]) ?> :: <?= str_replace("-", " ", $file_parts["title"]) ?></h1>
    </td>
</tr>
</table>



</body>
</html>