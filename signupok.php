<?
session_start();
$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$name = $_POST['name'];

if(str_replace(" ", "", $id) == "" || str_replace(" ", "", $pw) == "" || str_replace(" ", "", $name) == "") {
	echo("<script>alert('칸을 모두 채워주세요');history.back();</script>");
} else if($pw != $pw2) {
	echo("<script>alert('비밀번호가 일치하지 않습니다');history.back();</script>");
} else {
	$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
	$result = mysqli_fetch_array(mysqli_query($connect, "select * from Aamirkang_user where id='".$id."'"));
	if($result) {
		echo("<script>alert('이미 존재하는 아이입니다');history.back();</script>");
	} else {
		mysqli_query($connect, "INSERT INTO `Aamirkang_user` (`uuid`, `name`, `id`, `pw`) VALUES (DEFAULT, '".$name."', '".$id."', '".$pw."');");
		echo("<script>alert('회원가입이 완료되었습니다');location.href='login.php';</script>");
	}
}
?>