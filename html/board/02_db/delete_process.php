<?php 	
	require_once('board_functions.php');
		
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$post_id = $_GET['post_id'];
	}	
	$conn = get_sqlserver_conn();
	$delete_query = sprintf("DELETE FROM post WHERE post_id='%d'", $post_id);
	
	if (mysqli_query($conn, $delete_query) === false) {
		die(mysqli_error($conn));
	}
	printf("성공적으로 삭제되었습니다. <br>");
	printf("<br><a href='./board_write.php'><button>글쓰기</button></a>");
	printf("<a href='./index.php'><button>글목록</button></a> <br>");
	
	mysqli_close($conn);
?>
