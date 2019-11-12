<?
session_start();
$co_id = $_GET['co_id'];
$uuid = $_SESSION['uuid'];

$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "set session character_set_connection=utf8");
mysqli_query($connect, "set session character_set_results=utf8");
mysqli_query($connect, "set session character_set_client=utf8");

mysqli_query($connect, "delete from Aamirkang_agree where co_id=".$co_id." and uuid=".$uuid);
mysqli_query($connect, "update Aamirkang_comment set agree = agree - 1 where co_id=".$co_id);
exit("<script>history.back();</script>");
?>