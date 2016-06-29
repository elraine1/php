<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
	
	$conn = get_sqlserver_conn();
	make_dummy_post($conn, 200);
	mysqli_close($conn);
	
	printf("<h4>더미 생성 완료!</h4>");
	printf("<br><a href='./index.php'><button>원래 글로 돌아가기</button></a>");
?>
