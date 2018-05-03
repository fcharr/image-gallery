<?
$indexIages = glob("page*.*");
if(sizeof($indexIages) > 0) {
	include($indexIages[0]);
} else {
?>
<!DOCTYPE html>
<html>

<body>
<a href="./edit/">edit</a>
</body>
</html>
<?
}
?>