<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$post['post_id'] = $_POST['post_id'];
		$post['writer'] = $_POST['writer'];		// post_writer	
		$post['title'] = $_POST['title'];		// board_title
		$post['content'] = $_POST['content'];	// board_content
	}
	
	modify_post($post);

	printf("<a href='./index.php'><button>글목록</button></a><br>");
	
?>
