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
	a{
		text-decoration:none;
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
			
			$conn = get_sqlserver_conn();
			$select_query = "SELECT * FROM board ORDER BY bno DESC";
			// select 쿼리는 mysqli_query 함수의 반환값으로 결과를 받는다.
			
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$search_type = $_GET['search_type'];
				$search_word = $_GET['search_word'];
				
				if($search_word != null){
					$select_query = sprintf("SELECT * FROM board WHERE %s LIKE '\%%s\%' ORDER BY bno DESC", $search_type, $search_word );
				}
			}
			
			$result = mysqli_query($conn, $select_query);
			printf("<table>");
			printf("<tr> <th width='40'>BNO</th> <th width='40'>Writer</th> <th width='200'>Title</th> <th width='40'>Hits</th> <th width='80'>Date</th></tr>");
			while($board = mysqli_fetch_assoc($result)) {
				printf("<tr>");
				printf("<td id='td_num' align='center'><a href='./view_content.php?boardnum='%d'> %d </a></td>", $board['bno'], $board['bno']);
				printf("<td align='center'> %s </td>", $board['writer']);
				printf("<td align='left'><a href='./view_content.php?bno='%d'> %d </a></td>", $board['bno'], $board['bno']);
				printf("<td align='center'> %d </td>", $board['hits']);
				printf("<td align='center'> %s </td>", $board['written_date']);
				printf("</tr>");	
			}
			printf("</table>");
		
			mysqli_free_result($result);
			mysqli_close($conn);
			
		?>
		
		<br><a href="./board_write.php"><button>글쓰기</button></a><br>
		</div>
		<hr>
		
	</div>	
		
	<?php link_goto_main(); ?>

</body>
</html>s