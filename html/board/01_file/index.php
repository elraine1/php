<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<style type="text/css">
	.wrap{
		margin: 0 auto;
	}
	table{
		width: 50%;
		align: center;
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
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
		text-align: center;
	}
</style>
<body>
	<div id="wrap">
		
		<h2>게시판 연습</h2>
		<hr>
		<div id="div_table">
		<h3>글 목록</h3>				
		<?php	
			require_once('board_functions.php');
			
			$file_name = './board.txt';
			$lines = get_lines($file_name);	
			
			$board_info = array();
			$board = array();
			
			echo "<table>";
			echo "<tr><th>번호</th><th>작성자</th><th>제목</th></tr>";
			for($i=0; $i < count($lines); $i++){
				$board = get_board_content($lines[$i]);
				
				echo "<tr>";
				echo "<td id=\"td_num\"><a href='./view_content.php?boardnum=" . $board['number'] . "'> " . $board['number'] . "</a></td>";
				echo "<td> " . $board['writer'] . " </td>";
				echo "<td><a href='./view_content.php?boardnum=" . $board['number'] . "'> " . $board['title'] . "</a></td>";
				echo "</tr>";
			}	
			echo "</table>";
		?>
		<a href="./board_write.php"><button>글쓰기</button></a><br>
		</div>
		<hr>
		
	</div>	
		
	<?php link_goto_main(); ?>

</body>
</html>