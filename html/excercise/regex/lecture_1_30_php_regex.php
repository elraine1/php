<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php
/*
	$regex = '/<([^>]+)>([^<]+)<\/\1>/';
	$text = '<span>elem1</span><span>elem2</span>';
	
	$matches = array();
	preg_match($regex, $text, $matches);
	echo '전체 매칭: '.htmlspecialchars($matches[0]).'<br>';
	echo '괄호 1: '.htmlspecialchars($matches[1]).'<br>';
	echo '괄호 2: '.htmlspecialchars($matches[2]).'<br><br>';
		
	preg_match_all($regex, $text, $matches);
	echo '첫놈 전체매칭: '.htmlspecialchars($matches[0][0]).'<br>';
	echo '둘째놈 전체매칭: '.htmlspecialchars($matches[0][1]).'<br>';
	echo '첫놈 괄호 1: '.htmlspecialchars($matches[1][0]).'<br>';
	echo '둘째놈 괄호 2: '.htmlspecialchars($matches[1][1]).'<br>';		
	echo '첫놈 괄호 1: '.htmlspecialchars($matches[2][0]).'<br>';
	echo '둘째놈 괄호 2: '.htmlspecialchars($matches[2][1]).'<br><br>';
	
	echo htmlspecialchars('치환 결과: '.preg_replace($regex, '<\1 color="red">\2</\1>', $text));
	echo '<br><br>';

	$regex = '/[-:]+/';
	$text = '01 0  - 6 605: 19 17';
	$result = implode('-', preg_split($regex, $text));
	echo '원래 값: '.$text.'<br>';
	echo 'split 하고 implode 한 결과: '.$result.'<br>';
	echo '최종 replace 결과: '.preg_replace('/\s+/', '', $result);
*/
	
	/*
	$regex = '/[a]/';
	$text = 'a13-6a7aa88';
	
	echo htmlspecialchars('Q1. 원래 문자열: ' . $text ) . '<br>';
	echo htmlspecialchars('A1-1. 치환 결과: ' . preg_replace($regex, '<a>', $text) ) . '<br>';
	echo htmlspecialchars('A1-2. 치환 결과: ' . str_replace('a', '<a>', $text) );
	echo '<br><br>';
	
	
	$regex = '/(\d)/';
	$text = 'a123c4';
	echo htmlspecialchars('Q2. 원래 문자열: ' . $text ) . '<br>';
	echo htmlspecialchars('A2. 치환 결과: ' . preg_replace('/(\d)/', '<\1>', $text) ) . '<br>';
	
	echo '<br><br>';
	
//	$regex = '/([a-zA-Z]+)(\s+[a-zA-Z]*)*\s*\./';
	$regex = '/([a-zA-Z]+\s*)+\./';
	
	$text = 'I am a boy . She is a boy.';
	$replacement = '[SENTENCE]';
	echo htmlspecialchars('Q3. 원래 문자열: ' . $text ) . '<br>';
	echo htmlspecialchars('A3-1. 치환 결과: ' . preg_replace($regex, $replacement, $text) ) . '<br>';
	echo htmlspecialchars('A3-2. 치환 결과: ' . preg_replace($regex, '<\0>', $text) ) . '<br>';

	echo '<br><br>';
	
	$regex_word = '/([a-zA-Z]+)/';
	$regex_sentence = '/([a-zA-Z]+)(\s+[a-zA-Z]*)*\s*\./';
	$text = 'I am a boy . She is a boy.';
	
	echo htmlspecialchars('Q4. 원래 문자열: ' . $text ) . '<br>';
	echo htmlspecialchars('A4-1. 치환 결과: ' . preg_replace($regex_word, '[\0]', preg_replace($regex_sentence, '<\0>', $text))) . '<br>';
	
	echo '<br><br>';
	*/
	
	$text = "<  p         class=  \"my_class\"id    ='a2' > test123 < /p >";
	
	$regex = '/<\s*([a-zA-Z]+)\s+(([a-zA-Z]+)\s*=\s*((\"[\w]*\")|(\'[\w]*\'))\s*)*>([^<]+)<\s*\/\1\s*>/';	
	$replacement = "<TAG>";
	
	$matches = array();
	preg_match($regex, $text, $matches);
	
	
	echo "<textarea rows='20' cols='100';>";
	echo htmlspecialchars('Q5. 원래 문자열: ' . $text ) . "\n";
	echo htmlspecialchars('A5-0. 치환 결과: ' . preg_replace($regex, $replacement, $text) ) . "\n\n";

	$regex_prettify1 = '/\s+/';
	$replacement1 = ' ';
	$text = preg_replace($regex_prettify1, $replacement1, $text);
	echo htmlspecialchars('A5-1. 치환 결과: ' . $text ) . "\n";
	
	$regex_prettify2 = '/\s*=\s*/';
	$replacement2 = '=';
	$text = preg_replace($regex_prettify2, $replacement2, $text);
	echo htmlspecialchars('A5-2. 치환 결과: ' . $text ) . "\n";
	
	$regex_prettify3 = '/<\s*/';
	$replacement3 = '<';
	$text = preg_replace($regex_prettify3, $replacement3, $text);
	echo htmlspecialchars('A5-3. 치환 결과: ' . $text ) . "\n";
	
	$regex_prettify4 = '/\s*>/';
	$replacement4 = '>';
	$text = preg_replace($regex_prettify4, $replacement4, $text);
	echo htmlspecialchars('A5-4. 치환 결과: ' . $text ) . "\n";
	
	$regex_prettify5 = '/([^=])(\'|\")([\w]+)/';
	$replacement5 = '\1\2 \3';
	$text = preg_replace($regex_prettify5, $replacement5, $text);
	echo htmlspecialchars('A5-5. 치환 결과: ' . $text ) . "\n";
	
	
	echo "</textarea>";

	echo '<br><br>';
	
	
	
	
	
	
	$regex = '/([a-zA-Z]+)\s*=\s*/((\"[\w]*\")|(\'[\w]*\'))/';
	
	var a = "my";
	var b = "my" + "you";
	$a = "my"; 

	
	$regex = '/?<=\s+ [a-Z] + \s*=\s*"[^"]*" (?=\s*[a-z>])/';
	$regex = '/\s*[a-Z]+\s*=\s*"[^"]*"(?=\s*[a-Z>])/';
	// 
?>


<span class = "myclass" id = "a1">
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
</body>
</html>