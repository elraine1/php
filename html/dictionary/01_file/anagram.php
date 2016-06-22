<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>Anagram 찾기</h2>

	<?php 
		require_once('dictionary_functions.php');
		
		$words = get_all_words();
		$anagrams = get_anagrams($words);
		
		echo "<hr>";
		echo "<table>";
		foreach($anagrams as $group => $members){
			echo "<tr><td>[" . $group . "]</td><td> → </td><td>" . join(", ", $members) . "</td></tr>";
		}
		echo "</table>";
		echo "<hr>";
	?>

	<br><br>	
	[<a href="./top100.php">상위 100개 단어 보기</a>]<br>
	[<a href="./dictionary.php">상위 메뉴로</a>]<br>
	[<a href="/index.php">main으로</a>]
		
</body>
</html>