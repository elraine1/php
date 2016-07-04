<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">

	table, th, td{
		border: 1px solid gray;
	}
</style>

<html>

<?php 
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	$login_bar_path = $_SERVER['DOCUMENT_ROOT'] . '/board/03_login/user/login_header.php';
	
	require_once($mylib_path);
	require_once($login_bar_path);

?>


<body>
	<div id="wrap">
	<?php

	if (check_login()) {		
		printf("<h2>사용자 정보 확인</h2>");
		printf("<hr>");
		printf("<table>");
		printf("<tr><th>회원번호</th><td>%d</td></tr>", $_SESSION['user_id']);
		printf("<tr><th>아이디</th><td>%s</td></tr>", $_SESSION['username']);
		printf("<tr><th>비밀번호</th><td><input type='password' name='password'></td></tr>");
		printf("<tr><th>비밀번호 재입력</th><td><input type='password' name='password2'></td></tr>");
		printf("<tr><th>닉네임</th><td><input type='text' name='nickname' value='%s'></td></tr>", $_SESSION['nickname']);
		printf("<tr><th>이메일</th><td><input type='text' name='email' value='%s'></td></tr>", $_SESSION['email']);
		printf("<tr><th>가입일</th><td>%s</td></tr>", $_SESSION['join_date']);
		printf("</table>");
		printf("<a href='#'><button>회원정보 수정</button></a>");
	}
	
	?>		
		

		</div>
		<hr>
		
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>