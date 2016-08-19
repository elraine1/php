<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
				
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$post_id = $_GET['post_id'];
		$board_id = $_GET['board_id'];
	}	
	// delete function 작성할것.
	$conn = get_sqlserver_conn();
	$delete_query = sprintf("DELETE FROM post WHERE post_id='%d'", $post_id);
	
	if (mysqli_query($conn, $delete_query) === false) {
		die(mysqli_error($conn));
	}
	
	
	require_once("./user/session.php");
	start_session();
	
	$return_path = sprintf("./board_list.php?board_id=%d&page=1", $post['board_id']);
	header("Location: " . $return_path);
	
	mysqli_close($conn);
?>
