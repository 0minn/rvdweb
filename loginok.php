<?
session_start();
$id = $_POST['id'];
$pw = $_POST['pw'];

$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
$result = mysqli_fetch_array(mysqli_query($connect, "select * from Aamirkang_user where id='".$id."' and pw='".$pw."'"));

if(!$result) {
	echo("<script>alert('계정이 일치하지 않습니다');history.back();</script>");
} else {
	$_SESSION['uuid'] = $result['uuid'];
	$_SESSION['id'] = $result['id'];
	$_SESSION['name'] = $result['name'];
	echo("<script>location.href='index.php';</script>");
}
?>