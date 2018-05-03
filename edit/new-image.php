<!DOCTYPE html>

<?
include("globals.inc.php");

$page = isset($_GET["page"]) ? $_GET["page"] : 0;
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Image</title>

<script src="upload.js"></script>

<link rel="stylesheet" type="text/css" href="../blender.css" />
</head>

<body <? if(!$build) { ?>onload="init();"<? } ?>>

<?
include("header.html.php");
?>

<table>

<tr>
    <td colspan="3">
    <input  type="file" id="upload" onChange="preview();" />
    <input type="text" id="topic" value="" />
    <input type="text" id="title" value="" />
    <input type="hidden" id="prefix" value="<?= $totalNumberOfFiles ?>" />
    <input type="button" onClick="uploadImage();" value="save" />
    </td>
</tr>

<tr>

    
    
    <td>
    <a href="index.php?page=<?= $page ?>">
    <img id="image" src="" /></a>
    </td>
    
    
    
</tr>

</table>



</body>
</html>