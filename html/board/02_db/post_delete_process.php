<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
				
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$post_id = $_GET['post_id'];
	}	
	// delete function 작성할것.
	$conn = get_sqlserver_conn();
	$delete_query = sprintf("DELETE FROM post WHERE post_id='%d'", $post_id);
	
	if (mysqli_query($conn, $delete_query) === false) {
		die(mysqli_error($conn));
	}
	printf("성공적으로 삭제되었습니다. <br>");
	printf("<a href='./index.php'><button>홈으로</button></a> <br>");
	
	mysqli_close($conn);
?>
