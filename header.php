<html>
<head>
	<title>Aamirkang</title>
	<link rel="stylesheet" href="css/default.css" />
</head>
<body>
	<div id="header">
		<a href="/"><img src="img/logo.png" /></a>
		<div id="input-div">
			<input type="text" id="searchBar" name="search" placeholder="검색어를 입력하세요" />
			<img src="img/search.png" onclick="searchBoard()" />
			<script>
				function searchBoard() {
					var searchQuery = document.getElementById('searchBar').value;
					location.href='list.php?search='+searchQuery;
				}
			</script>
		</div>
		<div id="header-button">
			<? if(!isLogin()) { ?>
			<button><a href="login.php" style="color: #29487d; font-size: 16px;">로그인</a><font>을 해주세요</font></button>
			<? } else {?>
			<button><a href="write.php">게시글 만들기</a></button>
			<button><a href="logout.php"><font>로그아웃</font></a></button>
			<button><a href="#" style="color: #29487d; font-size: 16px;"><?=getName()?></a><font>님 안녕하세요</font></button>
			<? } ?>
		</div>
	</div>