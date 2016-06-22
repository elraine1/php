<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>단어사전 순위 검색</h2>

	<?php 
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$search_word = $_GET['search_word'];
		}
		
		$words = array();
		
		$file_name = '../data/dictionary.txt';
		$file_handle = fopen($file_name, "r");
		while( ($line = fgets($file_handle)) !== false ){

			// key => value.		
			$tmp = explode("\t", $line);
			if(count($tmp) == 2){
				if(strpos($tmp[0], $search_word) !== false){
					$words[] = $tmp[0];	
				}
			}else{					
				die('count was'.count($tmp).' Error occured!');
			}
		}
		fclose($file_handle);
		
		$words = array_unique($words);		// 단어 배열 중복 제거
		sort($words);						// 단어 배열 정렬
	
		$convert_font_words = convert_font_words($search_word, $words);		// 검색한 문자열에 대한 부분을 bold체로 변경하여 저장. 
		print_words($convert_font_words);									// 폰트가 변경된 문자열을 출력.

	?>

	<br><br>	
	[<a href="./top100.php">상위 100개 단어 보기</a>]<br>
	[<a href="./dictionary.php">다시하기</a>]
	[<a href="/index.php">main으로</a>]
		
</body>
</html>