<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<head>
	<title>Hello, World!</title>
  
</head>
<style type="text/css">
	h1 {
		text-align: center;
	}
	.wrap {
		background-color: LightSalmon;
		margin: 0 auto;
		height: 1200px;
		padding: 20px 50px 50px 50px;
	}
	#div_board {
		border: 1px solid #ededed;
		height: 150px;
		width: 90%;
		padding: 0px 15px 15px 15px;
		margin: 0 auto;
		background-color: Bisque ;
	}
	#div_etc {
		border: 1px solid #ededed;
		height: 500px;
		width: 90%;
		padding: 0px 15px 15px 15px;
		margin: 0 auto;
		background-color: PeachPuff;	
	}
	a {
		text-decoration:none;
	}
	a:visited {
		text-decoration:none;
	}
	a:hover {
		color:blue;
	}
</style>
<body>  
	 
	<div class="wrap">
		<h1>My PHP Pages</h1>
		<hr>
		<div id="div_board">
			<h3>Board</h3>
			<a href="/board/01_file/index.php">My Board</a> <br>
			<a href="/board/02_db/index.php">My Board(DB)</a> <br>
			<a href="/board/03_login/index.php">My Board(Login)</a> <br>
			<a href="/board/04_ajax/index.php"><b>My Board(AJAX)</b></a> <br>
		</div>
		<hr>
		<div id="div_board">
			<h3>Dictionary</h3>
			<a href="/dictionary/01_file/dictionary.php">Dictionary</a> <br>
			<a href="/dictionary/02_db/lecture_4_01.php">Dictionary(DB)</a> <br>
			<a href="/dictionary/03_ajax/lecture_4_01.php"><b>Dictionary(AJAX)</b></a> <br>
		</div>
		<hr>
		<div id="div_board">
			<h3>Security</h3>
			<a href="/security/01_file/index.php">Session Login</a> <br>
			<a href="/security/02_hashing/index.php">Hashing</a><br>
			<a href="/security/03_db/index.php">DB Login</a><br>
			
		</div>
		<hr>
		<div id="div_etc">
			<h3>etc</h3>
			<a href="/excercise/stringPractice/lecture_1_20_a.php">파일 읽기 연습1</a> <br>
			<a href="/excercise/stringPractice/lecture_1_20.php">파일 읽기 연습2</a> <br>
			<a href="/excercise/calculator/calculator.php">계산기</a> <br>
			<a href="/excercise/stringPractice2/practice.php">문자열 처리 연습</a><br>
			<a href="/excercise/permutation/permutation_index.php">순열 출력하기</a><br>
			<a href="/excercise/LCS/lcs_index.php">LCS</a><br>
			<a href="/excercise/diff/diff_index.php">DIFF</a><br>
			<a href="/excercise/regex/lecture_1_30_php_regex.php">regex</a><br>
			<a href="test.php">test</a><br>
			<a href="/excercise/php_javascript.php">test2</a><br>
			<a href="/excercise/mancala/test.php">mancala</a><br>
			<a href="/excercise/rss_reader/rss.php">rss</a><br>
			<a href="/excercise/eq/index.php">earch_quake</a><br>
			
			
			
		</div>
		<hr>
		
		<!--
		<div id="div_board">
			<h3>Project</h3>
			<?php 
				// $sturec_path = $_SERVER['DOCUMENT_ROOT'] . '/../../sturec/index.php';
				// printf("<a href='%s'>1차. 학생기록 관리(Sturec)</a><br>", $sturec_path);
			?>
		</div>
		-->
		
		<hr>
	</div>
</body>

  

</html>