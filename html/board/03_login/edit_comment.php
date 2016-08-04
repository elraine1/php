<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);	
	require_once('./user/session.php');
	start_session();
				
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$comment_id = $_POST['comment_id'];
		$comment = $_POST['content'];
	}	
	
	$conn = get_sqlserver_conn();
	$modify_query = sprintf("UPDATE comment SET comment = '%s' WHERE comment_id = %d", $comment, $comment_id);
	
	if (mysqli_query($conn, $modify_query) === false) {
		die(mysqli_error($conn));
	}
	
	mysqli_close($conn);
	echo 'success';
	
	
	$filename = 'log.txt';
	$file_handle = fopen($filename, 'w');
	
	fwrite($file_handle, "comment_id: " . $comment_id);
	fwrite($file_handle, "comment: " . $comment);
	fclose($file_handle);