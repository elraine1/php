<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>단어순 정렬 </h2>

	<?php 
		function print_top100_words($word_rank){
		
			echo "<h3>상위 100개 단어 출력</h3><br>";
			echo "<table>";
			echo "<tr><td>[ 번호 ]</td><td>[ 단어 ]</td><td>[ 순위 ]</td></tr>";
			$keys = array_keys($word_rank);
			for($i=0; $i<100; $i++){
				echo "<tr><td>No. " . ($i+1) . " : </td><td>" . $keys[$i] . " </td><td>" . $word_rank[$keys[$i]] . "</td><tr>";
			}	
			echo "</table>";
		}
	
		$file_name = './dictionary.txt';
		$word_rank = array();
		
		// dictionary read
		$file_handle = fopen($file_name, "r");
		while( ($line = fgets($file_handle)) !== false ){
			// key => value style.
			$tmp = explode("\t", $line);
			if(count($tmp) == 2){
				$word_rank[$tmp[0]] = $tmp[1];
			}else{					
				die('count was'.count($tmp).' Error occured!');
			}
		}
		fclose($file_handle);
		
		// 키 값으로 정렬 후 저장.
		ksort($word_rank);
		
		$file_name2 = './result.txt';
		if(!file_exists($file_name2)){
			$file_handle2 = fopen($file_name2, "w+");
			
			foreach($word_rank as $word => $rank){
				$line = $word . "\t" . $rank;
				fwrite($file_handle2, $line);
			}
			fclose($file_handle2);
		}
		print_top100_words($word_rank);
	?>
	
	<br><br>	
	[<a href="./top100.php">상위 100개 단어 보기</a>]<br>
	[<a href="./wordRank.php">단어 순위 검색</a>]<br>
	[<a href="/index.php">main으로</a>]
		
</body>
</html>