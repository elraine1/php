<?php 	
	require_once('board_functions.php');
		
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
	
	$conn = get_sqlserver_conn();
	$insert_query = "INSERT INTO board(writer, title, content) values('" . $board['writer'] . "','" . $board['title'] . "','" . $board['content'] . "') ";		
	if (mysqli_query($conn, $insert_query) === false) {
		die(mysqli_error($conn));
	}
	echo "성공적으로 작성되었습니다. <br>";
	echo "<br><a href='./board_write.php'><button>글쓰기</button></a>";
	echo "<a href='./index.php'><button>글목록</button></a> <br>";
	
	mysqli_close($conn);
?>
