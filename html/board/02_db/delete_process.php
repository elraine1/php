<?php 	
	require_once('board_functions.php');
		
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$request_num = $_GET['bno'];
	}	
	$conn = get_sqlserver_conn();
	$delete_query = sprintf("DELETE FROM board WHERE bno='%d'", $request_num);
	
	if (mysqli_query($conn, $delete_query) === false) {
		echo mysqli_error($conn);
	}
	echo "성공적으로 삭제되었습니다. <br>";
	echo "<br><a href='./board_write.php'><button>글쓰기</button></a>";
	echo "<a href='./index.php'><button>글목록</button></a> <br>";
	
	mysqli_close($conn);
?>
