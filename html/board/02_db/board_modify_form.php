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
				$request_num = $_GET['bno'];
			}	
			$conn = get_sqlserver_conn();
			
			$select_query = sprintf("SELECT * FROM board WHERE bno='%d'", $request_num);
			$result = mysqli_query($conn, $select_query);// result_set
			if (($board = mysqli_query($conn, $select_query)) === false) {
				echo mysqli_error($conn);
			}
			
			$board = mysqli_fetch_assoc($result);
			
			printf("<form action='modify_process.php' method='post'>");
			printf("<input type='hidden' name='bno' value='%d'>", $board['bno']);
			printf("<table>");
			printf("<tr><th>BNO</th> <td>%d</td></tr>", $board['bno']);
			printf("<tr><th>Writer</th> <td><input type='text' name='board_writer' value='%s'></td></tr>", $board['writer']);
			printf("<tr><th>Hits</th> <td>%d</td></tr>", $board['hits']);
			printf("<tr><th>Date</th> <td>%s</td></tr>", $board['last_update']);
			printf("<tr><th>Title</th> <td><input type='text' name='board_title' value='%s'></td></tr>",  $board['title'] );
			printf("<tr><td height='10' colspan='2'></td></tr>");
			printf("<tr><th colspan='2' align='center'>Content</th></tr>");
			printf("<tr><td id='td_content' colspan='2' align='center'><textarea name='board_content' rows='12' cols='135'>%s</textarea>", $board['content']);
			printf("<br><input type='submit' value='확인'></td></tr>");
			printf("</table>");
			printf("</form>");

			mysqli_free_result($result);
			mysqli_close($conn);
		?>	
		<a href="./board_write.php"><button>글작성</button></a>
		<a href="./index.php"><button>글목록</button></a> <br>
	</div>
	<hr>
	
</body>
</html>