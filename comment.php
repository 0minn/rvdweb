<?
session_start();
$bo_id = $_GET['bo_id'];
$writer = $_SESSION['uuid'];
$text = $_POST['commentText'];
$agree = 0;
$vote = $_POST['vote'];

$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "set session character_set_connection=utf8");
mysqli_query($connect, "set session character_set_results=utf8");
mysqli_query($connect, "set session character_set_client=utf8");

mysqli_query($connect, "insert into Aamirkang_comment values (default, ".$bo_id.", ".$writer.", '".$text."', ".$agree.", '".$vote."')");
if($vote == "true") {
	mysqli_query($connect, "update Aamirkang_board set agree = agree+1 where bo_id=".$bo_id);
} else {
	mysqli_query($connect, "update Aamirkang_board set disagree = disagree+1 where bo_id=".$bo_id);
}
echo "<script>alert('댓글을 작성하였습니다');location.href='view.php?bo_id=".$bo_id."&vote=".$vote."#peopleComentDiv';</script>";
?>