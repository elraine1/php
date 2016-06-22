<?php
////////////////////////////////////////////////////////////////////////////////////
///////////////////////// Dictionary Functions /////////////////////////////////////	
	
	// 사전의 모든 단어'만'을 반환해주는 함수. 
	function get_all_words(){
		
		$file_name = "./dictionary.txt";
		$file_handle = fopen($file_name, 'r');
		
		while(true){
			
			$line = fgets($file_handle);
			if($line === false){
				break; 
			}
			
			$tmp = explode("\t", $line);
			if(count($tmp) == 2){
				$words[] = $tmp[0];
			}else{				
				die('count was'.count($tmp).' Error occured!');
			}
		}
		sort($words);
		return $words;
	}
	
	// 검색 결과 출력
	function print_words($words){
		if(count($words) === 0){
			die("검색 결과가 없습니다. <br><br>");
		} else {
			echo "<h4>총 " . count($words) . "건의 검색 결과가 있습니다. </h4>";
			echo "<hr>";
			for($i=0; $i< count($words); $i++){
				echo "No. " . ($i+1) . " : " . $words[$i] . "<br>";
			}					
			echo "<hr>";
		}
	}
	
//////////////////////////////////////////////////////////////////////////////////
/////////////////////////// find substring Functions /////////////////////////////

	// 일치하는 부분열 볼드체로 변경.
	function convert_font_bold($search_word, $word){
		return str_replace($search_word, "<b>".$search_word."</b>", $word);			 
	}
	
	// substr에 해당하는 문자열에 대하여 bold체로 변경해주는 함수. 
	function convert_font_words($substr, $words){
	
		for($i=0; $i < count($words); $i++){
			$convert_words[] = convert_font_bold($substr, $words[$i]);
		}
		return $convert_words;
	}
	
///////////////////////////////////////////////////////////////////////////////
/////////////////////////// Palindrome Functions //////////////////////////////
		
	// palindrome 검증 함수.
	function is_palindrome($word){
		return (strcasecmp($word,strrev($word))==0);
	}
	
	// palindrome words를 구성해주는 함수.
	function get_palindrome_words($words){
		$palindrome_words = array();
		for($i=0; $i < count($words); $i++){
			if( (strlen($words[$i]) > 1) && (is_palindrome($words[$i])) ){
				$palindrome_words[] = $words[$i];
			}
		}
		return $palindrome_words;
	}
/////////////////////////////////////////////////////////////////////////////
///////////////////////////  Anagram Functions  /////////////////////////////
	function sort_characters_in_str($word){
		$string_parts = str_split($word);
		sort($string_parts);
		$result = implode("",$string_parts);
		
		return $result;
	}
	
	// 단어배열을 key-value형태의 배열로 변환. key값은 단어가, value는 단어내 문자열을 정렬한 값이 들어감. ex) words['apple'] => 'aelpp';
	function convert_keyvalue_arr($words){
		$result = array();
		for($i=0; $i < count($words); $i++){
			$result[$words[$i]] = sort_characters_in_str($words[$i]);
		}
		return $result;
	}
	
	// 사전 단어들에서 anagram group을 찾아 반환해주는 함수. 
	function get_anagrams($words){
		
		// 입력받은 단어 set을 arr['word'] = 'dorw' 형태로 변경. 
		$words2 = convert_keyvalue_arr($words);
		
		//value 값을 기준으로 anagram group을 형성.  ex) arr['aemt'] = array('meat', 'team', 'meta');
		$anagrams = array();
		foreach($words2 as $word => $group){
			$anagrams[$group][] = $word;
		}
		
		// 원소의 개수가 1인 group은 anagram 배열에서 pop. 
		foreach($anagrams as $group => $words){
			if(count($anagrams[$group]) == 1){
				unset($anagrams[$group]);
			}
		}
		return $anagrams;
	}
	
/////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
?>