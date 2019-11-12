<?
include("common.php");
include("header.php");
include("menu.php");
$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "set session character_set_connection=utf8");
mysqli_query($connect, "set session character_set_results=utf8");
mysqli_query($connect, "set session character_set_client=utf8");

$result_new = mysqli_query($connect, "select bo_id, title, writer as user, agree, disagree, (select id from Aamirkang_user where uuid=user) as userId from Aamirkang_board ORDER by bo_id DESC");
$result_pop = mysqli_query($connect, "select bo_id, title, writer as user, agree, disagree, (select id from Aamirkang_user where uuid=user) as userId, agree+disagree as total from Aamirkang_board ORDER by total DESC");
?>
	<div id="container">
		<div id="container-main">
			<div>
				<img src="img/banner_1.png" onclick="bannerView(1)" />
				<img src="img/banner_2.png" onclick="bannerView(2)" />
				<img src="img/banner_3.png" onclick="bannerView(3)" />
				<img src="img/banner_4.png" onclick="bannerView(4)" />
			</div>
			<script>
				let count = 1;
				const bannerArea = document.querySelector("#container-main div");
				moveBanner();
				function moveBanner() {
					setTimeout(function() {
						bannerArea.style.transform = 'translate('+(-100*count)+'%, 0)';
						count++;
						if(count == 4) count = 0;
						moveBanner();
					}, 10000);
				}
				function bannerView() {
					alert('페이지 이동');
				}
			</script>
			
		</div>
		<div id="container-list">
			<div class="container-list-area">
				<div class="container-list-area-title">
					<font>최근 올라온 토론</font>
					<a href="list.php?mode=new"><img src="img/addView.png" /></a>
				</div>
				<div class="container-list-area-list">
					<ul>
						<? while($row = mysqli_fetch_array($result_new)) { ?>
						<a href="view.php?bo_id=<?=$row['bo_id']?>"><li><?=$row['title']?></li></a>
						<? } ?>
					</ul>
				</div>
			</div>
			<div class="container-list-area">
				<div class="container-list-area-title" style="float: right;">
					<font>인기 토론</font>
					<a href="list.php?mode=pop"><img src="img/addView.png" /></a>
				</div>
				<div class="container-list-area-list" style="float: right;">
					<ul>
						<? while($row = mysqli_fetch_array($result_pop)) { ?>
						<a href="view.php?bo_id=<?=$row['bo_id']?>"><li><?=$row['title']?></li></a>
						<? } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script>
	</script>
</body>
</html>