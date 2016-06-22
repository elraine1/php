<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php
	$file_name = '../data/data2.txt';
	$number_of_total_lines = 5;
	echo $file_name;
	echo '<br>';
	$file_handle = fopen($file_name, 'r');
	if (!$file_handle) {
		die('file could not be opened!');
	}
	for ($line_number = 1; $line_number <= $number_of_total_lines; $line_number += 1) {
		// fgets는 파일의 다음 한 줄을 읽어서 그 문자열을 리턴한다.
		// 만약 더 이상 읽을 라인이 없다면, false 을 리턴한다.
		$line = fgets($file_handle);
		if ($line === false) {
			break;
		}
		$wordAndRank = explode("\t", $line);
		if (count($wordAndRank) === 2) {
			$word = $wordAndRank[0];
			$rank = intval($wordAndRank[1]);	// int로 캐스팅
		} else { // error
			die('count was'.count($wordAndRank).' Error occured!');
		}
		echo '단어: '.$word.' 순위: '.$rank,'<br>';
		
	}
	echo 'END';
	fclose($file_handle);
?>

	<br><br>
	<a href="/index.php">main으로</a>

</body>
</html>