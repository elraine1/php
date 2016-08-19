<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<?php
	
	$hostname='kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
	$username='SeokMin';
	$password='password';
	$dbname='SeokMin';
	
	$conn=mysqli_connect($hostname, $username, $password, $dbname);
	mysqli_query($conn, "SET NAMES 'utf8'");
	if (!($conn)) {
		die('Mysql connection failed: '.mysqli_connect_error());
	} 
	// 단어목록 파일을 DB 에 넣어보자
	
	$file_name = '../01_file/dictionary.txt';
	$file_handle = fopen($file_name, 'r');
	while ($line = fgets($file_handle)) {
		$wordAndRank = explode("\t", $line);
		if (count($wordAndRank) === 2) {
			$word = $wordAndRank[0];
			$rank = intval($wordAndRank[1]);
			// DB 작업
			$insert_query = 'INSERT INTO dictionary (word, rank) VALUES ("'.$word.'",'.$rank.')';
			if (mysqli_query($conn, $insert_query) === false) {
				echo "<a href='/index.php'><button>처음으로</button></a> <br>";
				die(mysqli_error($conn));
			}
			echo 'DB INSERT: '.$word,' ',$rank.'<br>';
		} else { // error
			die('data file error');
		}
	}
	echo 'DB INSERT 성공<br>';
	mysqli_close($conn);
?>
	<a href="/index.php"><button>처음으로</button></a> <br>
</body>
</html>