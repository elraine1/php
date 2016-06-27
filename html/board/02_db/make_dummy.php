<?php
	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
	
	$conn = get_sqlserver_conn();
	make_dummy_post(20);
	mysqli_close($conn);
	
	printf("<br><a href='./index.php'><button>원래 글로 돌아가기</button></a>");
?>
