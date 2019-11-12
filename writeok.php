<?
session_start();
$title = $_POST['title'];
$content = $_POST['content'];

$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "set session character_set_connection=utf8");
mysqli_query($connect, "set session character_set_results=utf8");
mysqli_query($connect, "set session character_set_client=utf8");

if(str_replace(" ", "", $title) == "" || str_replace(" ", "", $content) == "") {
	echo("<script>alert('칸을 모두 채워주세요');history.back();</script>");
} else {
	mysqli_query($connect, "INSERT INTO `Aamirkang_board` (`bo_id`, `writer`, `title`, `text`, `agree`, `disagree`) VALUES (DEFAULT, '".$_SESSION['uuid']."', '".$title."', '".$content."', '0', '0')");
	$result = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `Aamirkang_board` ORDER by bo_id DESC LIMIT 1"));
	echo("<script>alert('게시글을 작성하였습니다');location.href='view.php?bo_id=".$result['bo_id']."';</script>");
}
?>