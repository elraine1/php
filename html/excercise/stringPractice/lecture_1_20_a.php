<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php
	$file_name = '../data/data.txt';
	echo $file_name;
	echo '<br>';
	$file_handle = fopen($file_name, 'r');
	if (!$file_handle) {
		die('file could not be opened!');
	}

	// fgets는 파일의 다음 한 줄을 읽어서 그 문자열을 리턴한다.
	// 만약 더 이상 읽을 라인이 없다면, false을 리턴한다.
	while (!feof($file_handle)) { // 파일의 끝에 도달하면 작업을 중단한다
		$line = fgets($file_handle);
		echo '이번에 fgets로 읽은 부분: <'.$line.'><br>';
	}
	echo 'END<br>';
	
	// 파일은 다시 읽고 싶으면 비디오처럼 처음으로 돌려야 한다.
	rewind($file_handle); 
	while (!feof($file_handle)) {
		//fgets함수는 length에 지정된 길이에서 1바이트를 뺀 길이 만큼 읽어들인 값을 반환한다.
		$line = fgets($file_handle, 3); // 3 가아닌 2바이트씩 읽는다
		//$line = rtrim($line, "\r\n"); // fgets 는 뉴라인 문자를 포함한 결과를 준다
		echo '이번에 fgets로 읽은 부분: <'.$line.'><br>';
	}
	echo 'END<br>';
	
	rewind($file_handle); 
	// fgets의 반환값을 이용해서 파일을 다 읽었는지 판단할 수도 있다
	while ($line = fgets($file_handle, 5)) { // 파일의 끝에 도달했을 때에만 false가 나올 것이므로
		echo '이번에 fgets로 읽은 부분: <'.$line.'><br>';
	}
	echo 'END<br>';
	
	// 바로 위의 덩어리와 동일한 작업을, fgets의 인자만 바꿔서 다시 해보자
	rewind($file_handle); 
	while (($line = fgets($file_handle, 4)) !== false) {
		// 2번째 행의 마지막 0은 출력되지 않는다. 그 이유는 무엇인가?
		echo '이번에 fgets로 읽은 부분: <'.$line.'><br>';
	}
	echo 'END<br>';
	
	fclose($file_handle);
	
	
?>

	<br><br>
	<a href="/index.php">main으로</a>

</body>
</html>
