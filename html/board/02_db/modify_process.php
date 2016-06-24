<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$post['post_id'] = $_POST['post_id'];
		$post['writer'] = $_POST['writer'];		// board_writer	
		$post['title'] = $_POST['title'];		// board_title
		$post['content'] = $_POST['content'];	// board_content
	}

	// 작성자, 제목, 컨텐츠 중 내용이 하나라도 빠지면 die.
	if($post['writer'] == '' || $post['title'] == '' || $post['content'] == '' ){
		echo "<br><a href='./board_write.php'><button>글쓰기</button></a>";
		echo "<a href='./index.php'><button>글목록</button></a> <br>";
		die('not enough data.');
	}
	
	$conn = get_sqlserver_conn();
	$update_query = sprintf("UPDATE post SET writer='%s', title='%s', content='%s', last_update=now() WHERE post_id='%d'", $post['writer'], $post['title'], $post['content'], $post['post_id']);		
	if (mysqli_query($conn, $update_query) === false) {
		die(mysqli_error($conn));
	}
	echo "성공적으로 수정되었습니다. <br>";
	echo "<br><a href='./board_write.php'><button>글쓰기</button></a>";
	echo "<a href='./index.php'><button>글목록</button></a> <br>";
	
	mysqli_close($conn);
?>
