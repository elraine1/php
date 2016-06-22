<?php 

	function get_sqlserver_conn(){
		$hostname='kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
		$username='SeokMin';
		$password='password';
		$dbname='SeokMin';
		
		$conn=mysqli_connect($hostname, $username, $password, $dbname);
		mysqli_query($conn, "SET NAMES 'utf8'");
		if (!($conn)) {
			die('Mysql connection failed: '.mysqli_connect_error());
		} 
		
		return $conn;
	}

?>
