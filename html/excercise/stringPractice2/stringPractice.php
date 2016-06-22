<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>practice</h2>

	<?php
	
		if($_SERVER['REQUEST_METHOD'] == "GET"){			
			$input_word = $_GET['word'];
		}
	

		// 입력된 문자에 대응하는 값을 반환하는 함수.
		function get_number($str){
			return (ord($str)-ord('a')+1);
		}
		
		// 입력된 문자열에 대응하는 값을 반환하는 함수(각 철자의 누적합). 
		function get_number_sum($str){
			$sum = 0;
			for($i=0; $i < strlen($str); $i++){
				$sum += get_number(substr($str, $i));
			}
			return $sum;
		}
		

		// 입력된 단어와 같은 값을 가진 단어 모두 찾기(배열)
		function find_same_value_words($input_word){
			
			$file_name = '../data/dictionary.txt';
			$file_handler = fopen($file_name, "r");
			
			$value = get_number_sum($input_word);
			$words = array();
		
			while(($line = fgets($file_handler))!== false){
			
				$tmp = explode("\t", $line);
				if(count($tmp) == 2){
					$word = $tmp[0];
					if($value == get_number_sum($word)){
						$words[] = $word;
					}
				}else{
					die('count was'.count($tmp).' Error occured!');
				}	
			}	
			return $words;
		}
	
		// 입력된 단어 배열 출력.
		function print_words($words){
			for($i=0; $i<count($words); $i++){
				echo "No " . ($i+1). ". " . $words[$i] . " <br>";
			}
		}
	
		$word_value = get_number_sum($input_word);
		$words = find_same_value_words($input_word);
		
		echo $input_word . " => " . $word_value . "<br>";
		echo $input_word . "와 같은 값을 갖는 단어들 : <br>";
		echo print_words($words);
		
		
		
		
		
		
		
		
	?>
	
	<br><br>
	[<a href="./practice.php">다시 하기</a>]<br>
	[<a href="/index.php">main으로</a>]<br>
		
</body>
</html>