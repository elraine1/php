<?php 	
	require_once('board_functions.php');
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$board['board_id'] = $_POST['board_id'];
		$board['writer'] = $_POST['writer'];	// board_writer
		$board['title'] = $_POST['title'];		// board_title
		$board['content'] = $_POST['content'];	// board_content
	}
	
	// 게시물 작성.
	post_upload($board);
	
	printf("<br><a href='./board_write.php'><button>글쓰기</button></a>");
	printf("<a href='./index.php'><button>글목록</button></a><br>");
	
?>
