<?
error_reporting(0);
include("common.php");
include("header.php");
include("menu.php");

$bo_id = $_GET['bo_id'];
$connect = mysqli_connect("13.124.182.119", "Aamirkang", "8426753190", "Aamirkang");
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "set session character_set_connection=utf8");
mysqli_query($connect, "set session character_set_results=utf8");
mysqli_query($connect, "set session character_set_client=utf8");

$ag = 50;
$dag = 50;
$result = mysqli_fetch_array(mysqli_query($connect, "select title, writer as user, text, agree, disagree, (select name from Aamirkang_user where uuid=user) as name from Aamirkang_board where bo_id=".$bo_id));
if($result['agree'] == 0 && $result['disagree'] == 0) {
		$agree = 0;
		$disagree = 0;
} else {
	$agree = round($result['agree'] / ($result['agree']+$result['disagree']) * 100, 1);
	$disagree = round($result['disagree'] / ($result['agree']+$result['disagree']) * 100, 1);
	$ag = $agree;
	$dag = $disagree;
}

$voteResultAgree = mysqli_query($connect, "select co_id, text, agree, writer as user, (select name from Aamirkang_user where uuid=user) as name from Aamirkang_comment where bo_id=".$bo_id." and vote='true' order by agree desc");
$voteResultDisagree = mysqli_query($connect, "select co_id, text, agree, writer as user, (select name from Aamirkang_user where uuid=user) as name from Aamirkang_comment where bo_id=".$bo_id." and vote='false' order by agree desc");
$isIvote = mysqli_fetch_array(mysqli_query($connect, "select * from Aamirkang_comment where bo_id=".$bo_id." and writer=".getUuid()));
?>
    <div id="main">
        <div id="subMain">
            <div id="view">
                <div id="components">
                    <div id="problem">
                            <div id="bar">
                                <div id="truebar" style="width: <?=$ag?>%">
                                    <p>찬성</p>
                                    <p><?=$agree?>%</p>
                                </div>
                                <div id="falsebar" style="width: <?=$dag?>%">
                                    <p><?=$disagree?>%</p>
                                    <p>반대</p>
                                </div>
                            </div>
                            
                        <div id="titleDiv">
                            <p id="title"><?=$result['title']?></p>
                            <p id="subTitle"><?=$result['name']?>님이 올린 찬반토론</p>
                        </div>

                        <div id="menu">
							<? if(getUuid() == $result['user'] || $_SESSION['id'] == "admin") { ?>
                            <a href="delete.php?bo_id=<?=$bo_id?>"><button id="delete">글 삭제</button>
							<? } ?>
                            <a href="list.php?mode=new"><button id="delete">목록으로</button></a>
                        </div>

                        <p id="textTitle">Discussion</p>    
                        <div id="textDiv">
                            <p id="text"><?=$result['text']?></p>
                        </div>
                    </div>

                    <? if(isLogin()) { ?>
					<? if(!$isIvote) { ?>
                    <div id="vote">
                        <div id="subVote">
                            <div id="voteText">
                                <p>투표하기</p>
                            </div>
    
                            <div id="voteBar">
                                <div class="sub">
                                    <div id="voteTrueBar"></div>
                                    <div id="voteFalseBar"></div>
                                </div>
                            </div>
    
                            <div id="voteDiv">
                                <div class="sub2">
                                    <div id="voteTrue">
                                        <p>찬성</p>
                                        <div></div>
                                    </div>
                                    <div id="voteFalse">
                                        <p>반대</p>
                                        <div></div>
                                    </div>
                                    <div id="voteButton">
                                        <!--<button>투표</button>-->
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div id="comentText">
                        <p id="commentTitle">의견 쓰기</p>
                    </div>
                    <div id="comentInputDiv">
                        <form id="coment" method="post" action="comment.php?bo_id=<?=$bo_id?>">
                            <textarea id="voteTextarea" name="commentText" placeholder="주제와 무관한 의견이나 댓글은 경고없이 삭제 될수 있습니다."></textarea>
							<input id="voteSelect" name="vote" value="true" type="hidden" />
                            <div id="comentButtonDiv">
                                <button id="comentButton" onclick="voteForm()" type="button">등록</button>
								<script>
								function voteForm() {
									var voteText = document.getElementById('voteTextarea');
									if(voteText.value.replace(/ /gi, '') == '') {
										alert('내용을 입력해주세요');
									} else {
										document.getElementById('voteTextarea').value = document.getElementById('voteTextarea').value.replace(/(?:\r\n|\r|\n)/g, '<br/>');
										document.getElementById('coment').submit();
									}
								}
								</script>
                            </div>
                        </form>
                    </div>
					<? } ?>
					<? } ?>
                    
                </div>
            </div>
            
        </div>

        <div id="peopleComentDiv">
            <div id="peopleComentTitle">
                <p id="peopleComentTitleText">의견 보기</p>
            </div>


            <div id="peopleComentTrueDiv">
				<? while($row = mysqli_fetch_array($voteResultAgree)) { ?>
                <div class="peopleComent">
                    <div class="comentId">
                        <p>[</p>
                        <p>찬성</p>
                        <p>]</p>
                        <p><?=$row['name']?></p>
                    </div>
                    <div class="peopleComentText">
                        <p><?=$row['text']?></p>
                    </div>
                    <div class="peopleComentLike">
						<? if(isLogin()) { ?>
							<? if(!$isIvote) { ?>
								<a onclick="alert('투표를 먼저 진행해 주세요');"><img src="img/agree_none.png" class="commentImg" /></a>
							<? } else { ?>
								<? $tmp = mysqli_fetch_array(mysqli_query($connect, "select * from Aamirkang_agree where co_id=".$row['co_id']." and uuid=".getUuid())); ?>
									<? if($tmp) { ?>
									<a href="disagree.php?co_id=<?=$row['co_id']?>"><img src="img/agree_fill.png" class="commentImg" /></a>
									<? } else { ?>
									<a href="agree.php?co_id=<?=$row['co_id']?>&bo_id=<?=$bo_id?>"><img src="img/agree_none.png" class="commentImg" /></a>
									<? } ?>
							<? } ?>
						<? } else { ?>
							<a href="login.php"><img src="img/agree_none.png" class="commentImg" /></a>
						<? } ?>
						<p><?=$row['agree']?></p>
					</div>
                    <div class="comentBar"></div>

                </div>
				<? } ?>
            </div>
			
            <div id="peopleComentCenterLine"></div>
			
            <div id="peopleComentFalseDiv">
				<? while($row = mysqli_fetch_array($voteResultDisagree)) { ?>
                <div class="peopleComent">
                    <div class="comentId">
                            <p>[</p>
                            <p>반대</p>
                            <p>]</p>
                            <p><?=$row['name']?></p>
                    </div>
                    <div class="peopleComentText">
                        <p><?=$row['text']?></p>
                    </div>
                    <div class="peopleComentLike">
						<? if(isLogin()) { ?>
							<? if(!$isIvote) { ?>
								<a onclick="alert('투표를 먼저 진행해 주세요');"><img src="img/agree_none.png" class="commentImg" /></a>
							<? } else { ?>
								<? $tmp = mysqli_fetch_array(mysqli_query($connect, "select * from Aamirkang_agree where co_id=".$row['co_id']." and uuid=".getUuid())); ?>
									<? if($tmp) { ?>
									<a href="disagree.php?co_id=<?=$row['co_id']?>"><img src="img/agree_fill.png" class="commentImg" /></a>
									<? } else { ?>
									<a href="agree.php?co_id=<?=$row['co_id']?>&bo_id=<?=$bo_id?>"><img src="img/agree_none.png" class="commentImg" /></a>
									<? } ?>
							<? } ?>
						<? } else { ?>
							<a href="login.php"><img src="img/agree_none.png" class="commentImg" /></a>
						<? } ?>
						<p><?=$row['agree']?></p>
					</div>
                    <div class="comentBar"></div>
                </div>
				<? } ?>
            </div>

        </div>  
    </div>
    <script src="view.js"></script>
</body>
</html>