<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<?php 
	function get_profile_by_username(){
		
		return	$profile;
	}
	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	
	
	require_once($mylib_path);
	require_once("session.php");
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$username = $_GET['username'];
	}
	
	if (check_login()) {		
		
?>


<body>
	<div id="wrap">
	<?php

	
		
		echo "<h1>USER PROFILE PAGE</h1>";

	?>		
		
		<div id="div_table">
			<table>
			
			
			
			</table>
		
		
		
	<?php } ?>		
		</div>
		<hr>
		
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>