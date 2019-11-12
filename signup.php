<?
include("common.php");
include("header.php");

if(isLogin()) {
	exit("<script>alert('로그인 중입니다');location.href='index.php'</script>");
}
?>
    <div id="login">
        <div id="center">
            <div>
            <div>
                <p id="signuptitle">회원가입</p>
                <div id="logo">
                    <img src="img/logo.png"/>
                </div>
            </div>
			<form id="signupForm" action="signupok.php" method="post">
            <div id="inputDiv">
                <input type="text" name="id" id="id" placeholder="아이디"/>
                <input type="password" name="pw" id="password" placeholder="비밀번호"/>
                <input type="passwordCheck" name="pw2" id="password" placeholder="비밀번호 확인">
                <input type="text" name="name" id="nickname" placeholder="닉네임"/>
            </div>
			</form>
            <div id="buttonDiv">
                <button id="loginButton" onclick="signup()">회원가입</button>
				<script>
					function signup() {
						document.getElementById('signupForm').submit();
					}
				</script>
            </div>
        </div>
        </div>
    </div>
</body>
</html>