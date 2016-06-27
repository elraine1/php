<?php
		
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$comment['post_id'] = $_POST['post_id'];
		$comment['writer'] = $_POST['writer'];
		$comment['comment'] = $_POST['comment'];
	}	
	
	// 작성자, 제목, 컨텐츠 중 내용이 하나라도 빠지면 die.
	if($comment['writer'] == '' || $comment['comment'] == '' ){
		printf("<br><a href='./post_write_form.php'><button>글쓰기</button></a>");
		printf("<a href='./index.php'><button>홈으로</button></a><br>");
		die('not enough data.');
	}
	
	comment_upload($comment);
	
	printf("<br><a href='./view_post.php?post_id=%s'><button>원래 글로 돌아가기</button></a>", $comment['post_id']);
	
	

?>
