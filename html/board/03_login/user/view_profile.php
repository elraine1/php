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
	
	require_once($mylib_path);
	require_once("session.php");
	start_session();
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$username = $_GET['username'];
	}
	
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
		printf("<tr><th>닉네임</th><td>%s</td></tr>", $_SESSION['nickname']);
		printf("<tr><th>가입일</th><td>%s</td></tr>", $_SESSION['join_date']);
		printf("</table>");
		printf("<button>내가 작성한 글</button><button>회원정보 변경</button>");
	}
	else{
		echo "tttt";
	}
	?>		
		

		</div>
		<hr>
		
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>