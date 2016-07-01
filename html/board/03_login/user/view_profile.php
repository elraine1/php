<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<?php 
	function get_profile_by_username(){
		
		return	$profile;
	}
		
?>


<body>
	<div id="wrap">
	<?php
		$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
		$login_bar_path = $_SERVER['DOCUMENT_ROOT'] . '/board/03_login/user/login_header.php';
		
		require_once($mylib_path);
		require_once($login_bar_path);
			
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$username = $_GET['username'];
		}
		
		echo "<h1>USER PROFILE PAGE</h1>";

	?>		
		
		<div id="div_table">
			<table>
			
			
			
			</table>
		
		
		
		
		</div>
		<hr>
		
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>