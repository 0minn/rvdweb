<?
error_reporting(0);
include("common.php");
include("header.php");
include("menu.php");

$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "set session character_set_connection=utf8");
mysqli_query($connect, "set session character_set_results=utf8");
mysqli_query($connect, "set session character_set_client=utf8");

$search = $_GET['search'];

if($_GET['mode'] == "pop") {
	$result = mysqli_query($connect, "select bo_id, title, writer as user, agree, disagree, (select id from Aamirkang_user where uuid=user) as userId, agree+disagree as total from Aamirkang_board ORDER by total DESC");
	$title = "인기";
} else if($_GET['mode'] == "new") {
	$title = "최신";
	$result = mysqli_query($connect, "select bo_id, title, writer as user, agree, disagree, (select id from Aamirkang_user where uuid=user) as userId from Aamirkang_board ORDER by bo_id DESC");
} else if($search) {
	$title = "'".$search."'에 대한";
	$result = mysqli_query($connect, "select bo_id, title, writer as user, agree, disagree, (select id from Aamirkang_user where uuid=user) as userId from Aamirkang_board where title like '%".$search."%'");
} else {
	exit("<script>alert('검색어를 입력하세요');history.back();</script>");
}

$count = mysqli_num_rows($result);
?>
<div id="listMain">
        <div id="test">
            <div id="listTitleDiv">
                <p id="listTitle"><?=$title?> 게시물</p>
            </div>
            <div id="listDiv">
                <table id="list">
                    <tr>
                        <td>No</td>
                        <td>제목</td>
                        <td>글쓴이</td>
                        <td>투표상황</td>
                    </tr>
					<? while($row = mysqli_fetch_array($result)) {
							$agree = $row['agree'];
							$disagree = $row['disagree'];
							try {
								$ag = round($agree / ($agree+$disagree) * 100, 1);
								$dag = round($disagree / ($agree+$disagree) * 100, 1);
							} catch(Exception $e) {
								$ag = 0;
								$dag = 0;
							}
					?>
                    <tr>
                        <td><?=$count--?></td>
                        <td><a href="view.php?bo_id=<?=$row['bo_id']?>"><?=$row['title']?></a></td>
                        <td><?=$row['userId']?></td>
						<td><font color="#2959AC"><?=$ag?>%</font><font color="#FF0000"><?=$dag?>%</font></td>
                    </tr>
					<? } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>