<?
session_start();

function isLogin() {
	if($_SESSION['uuid'] != null) {
		return true;
	} else {
		return false;
	}
}
function getUuid() {
	return $_SESSION['uuid'];
}
function getName() {
	return $_SESSION['name'];
}
?>