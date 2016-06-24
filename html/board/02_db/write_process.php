<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);	
				
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$board['board_id'] = $_POST['board_id'];
		$board['writer'] = $_POST['writer'];	// board_writer
		$board['title'] = $_POST['title'];		// board_title
		$board['content'] = $_POST['content'];	// board_content
	}
	
	// 작성자, 제목, 컨텐츠 중 내용이 하나라도 빠지면 die.
	if($post['writer'] == '' || $post['title'] == '' || $post['content'] == '' ){
		printf("<br><a href='./board_write.php'><button>글쓰기</button></a>");
		printf("<a href='./index.php'><button>글목록</button></a><br>");
		die('not enough data.');
	}
	
	// 게시물 작성.
	post_upload($board);
	
	printf("<br><a href='./board_write.php'><button>글쓰기</button></a>");
	printf("<a href='./index.php'><button>글목록</button></a><br>");
?>
