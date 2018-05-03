<?
$submitted_user = isset($_POST['user']) ? $_POST['user'] : null;
$submitted_password = isset($_POST['password']) ? $_POST['password'] : null;

if($submitted_user !== null && $submitted_password !== null) {
	setcookie("user", $submitted_user);
	setcookie("password", $submitted_password);
}
?>
document.location.reload(true);