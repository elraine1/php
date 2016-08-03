<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);	
	
	require_once('./user/session.php');
	start_session();
				
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$comment_id = $_POST['comment_id'];
		$comment = $_POST['content'];
	}	
	// delete function 작성할것.
	$conn = get_sqlserver_conn();
	$modify_query = sprintf("UPDATE comment SET comment = '%s' WHERE comment_id = %d", $comment, $comment_id);
	
	echo $modify_query;
	if (mysqli_query($conn, $modify_query) === false) {
		die(mysqli_error($conn));
	}
	
	$request_uri = $_SESSION['request_uri'];
	header("Location: " . $request_uri);
	
	mysqli_close($conn);
?>
