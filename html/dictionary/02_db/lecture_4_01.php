<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = 'oracle';
	$dbname = 'seokmin';
	$conn = mysqli_connect($hostname, $username, $password, $dbname);
	if (!$conn) {
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
				echo mysqli_error($conn);
			}
			echo 'DB INSERT: '.$word,' ',$rank.'<br>';
		} else { // error
			die('data file error');
		}
	}
	echo 'DB INSERT 성공<br>';
	mysqli_close($conn);
?>
</body>
</html>