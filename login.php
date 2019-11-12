<?
include("common.php");
include("header.php");
?>
    <div id="login">
        <div id="center">
            <div>
            <div>
                <p id="signintitle">로그인</p>
                <div id="logo">
                    <img src="img/logo.png"/>
                </div>
            </div>
			<form id="loginForm" action="loginok.php" method="post">
            <div id="inputDiv">
                <input type="text" name="id" id="id" placeholder="아이디"/>
                <input type="password" name="pw" id="password" placeholder="비밀번호"/>
            </div>
			</form>
            <input id="rememberIdCheck" type="checkbox"/>
            <span>아이디 기억하기</span>
            <div id="signupButtonDiv">
                <a href="signup.php"><button id="signupButton">회원가입</button></a>
            </div>
            <div id="buttonDiv">
                <button id="loginButton" onclick="login()">로그인</button>
				<script>
					function login() {
						document.getElementById('loginForm').submit();
					}
				</script>
            </div>
        </div>
        </div>
    </div>
</body>
</html>