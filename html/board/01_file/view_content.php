<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<style type="text/css">
	table{
		width:50%;
		align:center;
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
		margin: 10px;
	}
	th{
		background-color: LightSkyBlue ;
		border: 1px solid LightSeaGreen;
	}
	td, tr{
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
	}
	#td_num{
		text-align:center;
	}
	#td_content{
		 height: 150px;
	}
	</style>
</head>
<body>

	<h1>나의 게시판</h1>
	<hr>
	<div class="content">	
		<?php
			require_once('board_functions.php');
			
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$request_num = $_GET['boardnum'];
			}	
			
			$file_name = './board.txt';
			$lines = get_lines($file_name);	
			$board = get_board_content($lines[($request_num-1)]);
			
			echo "<table>";
			echo "<tr><th>번호</th><th>" . $board['number'] . "</th></tr>";
			echo "<tr><td>작성자</td><td>" . $board['writer'] . "</td></tr>";
			echo "<tr><td>제목</td><td>" . $board['title'] . "</td></tr>";
			echo "<tr><th colspan='2' align='center'>내용</th></tr>";
			echo "<tr><td id='td_content' colspan='2'>" . $board['content'] . "</td></tr>";
			echo "</table>";
		?>	
		
		<a href="./board_write.php"><button>글쓰기</button></a>
		<a href="./index.php"><button>글목록</button></a> <br>
	</div>
	<hr>
	<?php link_goto_main(); ?>
	
</body>
</html>