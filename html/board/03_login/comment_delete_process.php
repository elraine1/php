<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);	
	
	require_once('./user/session.php');
	start_session();
				
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$comment_id = $_GET['comment_id'];
	}	
	// delete function 작성할것.
	$conn = get_sqlserver_conn();
	$delete_query = sprintf("DELETE FROM comment WHERE comment_id=%d", $comment_id);
	
	if (mysqli_query($conn, $delete_query) === false) {
		die(mysqli_error($conn));
	}
	
	$request_uri = $_SESSION['request_uri'];
	header("Location: " . $request_uri);
	
	mysqli_close($conn);
?>
