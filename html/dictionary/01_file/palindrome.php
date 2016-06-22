<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>Palindrome Words</h2>

	<?php 
		require_once('dictionary_functions.php');
	
		$words = get_all_words();
		$palin_words = get_palindrome_words($words);
		print_words($palin_words);
	?>

	<br><br>	
	[<a href="./top100.php">상위 100개 단어 보기</a>]<br>
	[<a href="./dictionary.php">상위 메뉴로</a>]<br>
	[<a href="/index.php">홈으로</a>]<br>
		
</body>
</html>