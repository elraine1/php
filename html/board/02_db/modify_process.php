<?php 	
	require_once('board_functions.php');
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$board['bno'] = $_POST['bno'];
		$board['writer'] = $_POST['board_writer'];		// board_writer	
		$board['title'] = $_POST['board_title'];		// board_title
		$board['content'] = $_POST['board_content'];	// board_content
	}

	// 작성자, 제목, 컨텐츠 중 내용이 하나라도 빠지면 die.
	if($board['writer'] == '' || $board['title'] == '' || $board['content'] == '' ){
		echo "<br><a href='./board_write.php'><button>글쓰기</button></a>";
		echo "<a href='./index.php'><button>글목록</button></a> <br>";
		die('not enough data.');
	}
	
	echo $board['content'] . "<br>";
	$conn = get_sqlserver_conn();
	$update_query = sprintf("UPDATE board SET writer='%s', title='%s', content='%s', last_update=now() WHERE bno='%d'", $board['writer'], $board['title'], $board['content'], $board['bno']);		
	if (mysqli_query($conn, $update_query) === false) {
		die(mysqli_error($conn));
	}
	echo "성공적으로 수정되었습니다. <br>";
	echo "<br><a href='./board_write.php'><button>글쓰기</button></a>";
	echo "<a href='./index.php'><button>글목록</button></a> <br>";
	
	mysqli_free_result($result);
	mysqli_close($conn);
?>
