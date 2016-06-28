<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);	
				
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$post['board_id'] = $_POST['board_id'];
		$post['writer'] = $_POST['writer'];	// post_writer
		$post['title'] = $_POST['title'];		// post_title
		$post['content'] = $_POST['content'];	// post_content
	}
	
	// 작성자, 제목, 컨텐츠 중 내용이 하나라도 빠지면 die.
	if($post['writer'] == '' || $post['title'] == '' || $post['content'] == '' ){
		printf("<br><a href='./board_list.php?board_id=%d&page=1'><button>글목록</button></a>", $post['board_id']);
		printf("<a href='./index.php'><button>홈으로</button></a><br>");
		die('not enough data.');
	}
	
	// 게시물 작성.
	echo "<br>";
	post_upload($post);
	
	printf("<br><a href='./board_list.php?board_id=%d&page=1'><button>글목록</button></a>", $post['board_id']);
	printf("<a href='./index.php'><button>홈으로</button></a><br>");
?>
