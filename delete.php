<?
$bo_id = $_GET['bo_id'];

$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "DELETE FROM `Aamirkang_board` WHERE `Aamirkang_board`.`bo_id` = ".$bo_id);

echo "<script>alert('게시글이 삭제되었습니다');location.href='list.php?mode=new'</script>";
?>