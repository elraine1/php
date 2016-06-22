<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>단어사전 순위 검색</h2>

	<?php 
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$search_word = $_GET['search_word'];
		}
		
		$word_rank = array();
		
		$file_name = '../data/dictionary.txt';
		$file_handle = fopen($file_name, "r");
		while( ($line = fgets($file_handle)) !== false ){

			// key => value.		
			$tmp = explode("\t", $line);
			if(count($tmp) == 2){
				$word_rank[$tmp[0]] = $tmp[1];
			}else{					
				die('count was'.count($tmp).' Error occured!');
			}
		}
		fclose($file_handle);
		
		// 배열내에 key 값이 존재하는지 확인.
		if(array_key_exists($search_word, $word_rank)){
				
			echo "[ <b>" . $search_word . " </b> ]는 ";
			if($word_rank[$search_word] < 100){ 
				echo "<b>" . $word_rank[$search_word] . "위 </b>"; 
			}else {
				echo $word_rank[$search_word] . "위 ";
			}
			echo "입니다.<br>";
		}else{
			echo "검색 결과가 없습니다. <br>";
		}
	?>

	<br><br>	
	[<a href="./top100.php">상위 100개 단어 보기</a>]<br>
	[<a href="./dictionary.php">다시하기</a>]
	[<a href="/index.php">main으로</a>]
		
</body>
</html>