<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>두 단어를 엮어 다른 단어가 되는 것 찾기</h2>

	<?php 
		require_once('dictionary_functions.php');
		

		
		function is_compose_word($word_A, $word_B, $words){
			
			$words2 = convert_keyvalue_arr($words);
			asort($words2);
		
			//value 값을 기준으로 anagram group을 형성.  ex) arr['aemt'] = array('meat', 'team', 'meta');
			$sorted_strings = array();
			foreach($words2 as $word => $group){
				$sorted_strings[$group][] = $word;
			}
			
			$chk_word = sort_characters_in_str($word_A.$word_B);
			
			if(isset($sorted_strings[$chk_word])){
				return $sorted_strings[$chk_word];
			}else{
				return false;
			}
		}
		
		$words = get_all_words();
		
		$word_A = 'teb';
		$word_B = 'ret';
		
		echo "word_A : " . $word_A . "<br>";
		echo "word_B : " . $word_B . "<br>";
		echo join(", ", is_compose_word($word_A, $word_B, $words)) . "<br>";
	?>

	<br><br>	
	[<a href="./top100.php">상위 100개 단어 보기</a>]<br>
	[<a href="./dictionary.php">상위 메뉴로</a>]<br>
	[<a href="/index.php">main으로</a>]
		
</body>
</html>