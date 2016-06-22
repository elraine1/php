<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h1>단어 사전</h1>
	<h2>단어 순위 검색</h2>
	<form action="wordRank.php" method="GET">
		단어: <input type="text" name="search_word">
		<input type="submit" value="제출">
	</form>
	
	<br><br>
	<h2>부분문자열이 포함된 단어 찾기</h2>
	<form action="find_substr.php" method="GET">
		단어: <input type="text" name="search_word">
		<input type="submit" value="제출">
	</form>
	
	<br><br><br>
	[<a href="./top100.php">상위 100개 단어 보기</a>]<br>
	[<a href="./anagram.php">Anagram in dictionary</a>]<br>
	[<a href="./palindrome.php">Palindrome in dictionary</a>]<br>
	[<a href="./word_compose.php">word compose</a>]<br>
	[<a href="./rsort.php">단어순 정렬</a>]<br>
	[<a href="/index.php">main으로</a>]
</body>
</html> 