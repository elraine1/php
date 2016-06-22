<?php 

	function get_mysql_conn(){
		$hostname='localhost';
		$username='root';
		$password='oracle';
		$dbname='seokmin';
		
		$conn=0;
		if (!($conn=mysqli_connect($hostname, $username, $password, $dbname))) {
			die('Mysql connection failed: '.mysqli_connect_error());
		} 
		return $conn;
	}

?>
