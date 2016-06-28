<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<head>
	<title>Hello, World!</title>

	<style type="text/css">
		
		th{
			background-color: gray;
		}
		
		table, td, th{
			border: 1px solid blue;
		}
	</style>
	
</head>


<body>  
	 
	<div class="wrap">
		<h2>Longest Common Subsequence Test</h2>
		<hr>
	
		<?php
			require_once("lcs_functions.php");
		
			if($_SERVER['REQUEST_METHOD'] == 'GET'){		
				$str1 = $_GET['str1'];
				$str2 = $_GET['str2'];
			}
			echo "str1: " . $str1 . "<br>";
			echo "str2: " . $str2 . "<br><br>";
			
			make_diff_table($str1, $str2);
			
			echo "<hr>";
			
			//$str_concat = $str1 . $str2;
			
			
			
			
			
			echo "<hr>";
		?>	
	
		<hr>
		<a href="./lcs_index.php"><button>다시하기</button></a><br>
	</div>
</body>

  

</html>