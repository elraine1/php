<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<style type="text/css">
	h1 {
		text-align: center;
	}
	.wrap {
		background-color: LightSalmon;
		margin: 0 auto;
		height: 900px;
		padding-top: 10px;
		padding-bottom: 60px;
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
		height: 200px;
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
		<h1>Test Example</h1>
		<hr>
		<div id="div_board">
			<h3>Board</h3>
			<a href="/board/01_file/index.php">My Board</a> <br>
			<a href="/board/02_db/index.php">My Board(DB)</a> <br>
		</div>
		<hr>
		<div id="div_board">
			<h3>Dictionary</h3>
			<a href="/dictionary/01_file/dictionary.php">Dictionary</a> <br>
			<a href="/dictionary/02_db/lecture_4_01.php">DB 입력</a> <br>
			
		</div>
		<hr>
		<div id="div_board">
			<h3>Security</h3>
			<a href="/security/01_file/index.php">Session Login</a> <br>
			<a href="/security/02_hashing/index.php">Hashing</a><br>
		</div>
		<hr>
		<div id="div_etc">
			<h3>etc</h3>
			<a href="/excercise/stringPractice/lecture_1_20_a.php">파일 읽기 연습1</a> <br>
			<a href="/excercise/stringPractice/lecture_1_20.php">파일 읽기 연습2</a> <br>
			<a href="/excercise/calculator/calculator.php">계산기</a> <br>
			<a href="/excercise/stringPractice2/practice.php">문자열 처리 연습</a><br>
			<a href="/excercise/permutation/permutation_index.php">순열 출력하기</a><br>
		</div>
		<hr>
	</div>
</body>
</html>