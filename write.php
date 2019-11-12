<?
include("common.php");
include("header.php");
?>
    <div id="upload">
		<form id="writeForm" action="writeok.php" method="post">
        <div id="upload_subDiv">
            <div id="upload_TitleDiv">
                <p id="upload_Title">토론 만들기</p>
                <button id="upload_Button" onclick="boardWrite()" type="button">게시물 만들기</button>
				<script>
					function boardWrite() {
						document.getElementById('upload_componentText').value = document.getElementById('upload_componentText').value.replace(/(?:\r\n|\r|\n)/g, '<br/>');
						document.getElementById('writeForm').submit();
					}
				</script>
            </div>
            <div id="upload_Component">
                <div id="t">
                    <div id="upload_componentTitleDiv">
                        <div>
                            <span>토론 주제</span>
                        </div>
                        <input type="text" name="title" id="upload_componentTitle" placeholder="토론 주제를 입력하세요">
                    </div>
                    <div id="upload_componentTextDiv">
                        <div>
                            <span>Discussion</span>
                        </div>
                        <textarea id="upload_componentText" name="content" placeholder="주제에 관한 내용을 최대한 쟁점이 드러나도록 자세히 서술해 주십시오"></textarea>
                    </div>
                </div>
            </div>
        </div>
		</form>
    </div>
</body>
</html>