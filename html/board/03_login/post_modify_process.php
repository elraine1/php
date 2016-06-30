<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$post['post_id'] = $_POST['post_id'];
		$post['writer'] = $_POST['writer'];		// post_writer	
		$post['title'] = $_POST['title'];		// board_title
		$post['content'] = $_POST['content'];	// board_content
	}
	
	// 작성자, 제목, 컨텐츠 중 내용이 하나라도 빠지면 die.
	if($post['writer'] == '' || $post['title'] == '' || $post['content'] == '' ){
		printf("<br><a href='./view_post.php?post_id=%s'><button>원래 글로 돌아가기</button></a>", $post['post_id']);
		printf("<a href='./index.php'><button>홈으로</button></a><br>");
		die('not enough data.');
	}
	
	modify_post($post);

	printf("<br><a href='./view_post.php?post_id=%s'><button>수정된 글 확인</button></a>", $post['post_id']);
	printf("<a href='./index.php'><button>홈으로</button></a><br>");
	
?>
