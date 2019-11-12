<?
session_start();
$bo_id = $_GET['bo_id'];
$co_id = $_GET['co_id'];
$uuid = $_SESSION['uuid'];

$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "set session character_set_connection=utf8");
mysqli_query($connect, "set session character_set_results=utf8");
mysqli_query($connect, "set session character_set_client=utf8");

$result = mysqli_fetch_array(mysqli_query($connect, "select vote from Aamirkang_comment where writer=".$uuid." and bo_id=".$bo_id));
$vote = mysqli_fetch_array(mysqli_query($connect, "select vote from Aamirkang_comment where co_id=".$co_id));
if($result != $vote) {
	exit("<script>alert('자신의 의견과 같은 댓글에만 공감버튼을 누를 수 있습니다');history.back()</script>");
}

mysqli_query($connect, "insert into Aamirkang_agree values (default, ".$co_id.", ".$uuid.")");
mysqli_query($connect, "update Aamirkang_comment set agree = agree + 1 where co_id=".$co_id);
exit("<script>history.back();</script>");
?>