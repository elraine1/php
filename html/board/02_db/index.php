<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<style type="text/css">
	#wrap{
		margin: 0 auto;
	}
	table{
		width: 60%;
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
		text-decoration: none;
	}
	
	#div_table{
		margin: 0 auto;
		width: 100%;
	}
	
	#div_search{
		width: 60%;
		text-align: right;
		margin: 0;
	}
</style>
<body>
	<div id="wrap">
		
		<h2>게시판 연습</h2>
		<div id="div_table">		
			<?php	
				require_once('board_functions.php');
				
				$conn = get_sqlserver_conn();
				$board_info = get_all_board_info($conn);			
				
				foreach($board_info as $board_id => $board_name){		// 게시판별 테이블 작성.
					printf("<hr>");
					printf("<h3>%s 게시판</h3>", $board_name);
					printf("<table>");
					printf("<tr> <th width='40'>POST_ID</th> <th width='80'>WRITER</th> <th width='200'>TITLE</th> <th width='40'>HITS</th> <th width='90'>DATE</th></tr>");
					
					$select_query = sprintf("SELECT * FROM post WHERE board_id = %s ORDER BY post_id DESC", $board_id);
					$result = mysqli_query($conn, $select_query);
					while($post = mysqli_fetch_assoc($result)) {
						printf("<tr>");
						printf("<td id='td_num' align='center'><a href='./view_content.php?board_id=%d&post_id=%d'>%d</a></td>", $board_id, $post['post_id'], $post['post_id']);
						printf("<td align='center'>%s</td>", $post['writer']);
						printf("<td align='left'><a href='./view_content.php?board_id=%d&post_id=%d'>%s</td>", $board_id, $post['post_id'],$post['title']);
						printf("<td align='center'>%d</td>", $post['hits']);
						printf("<td align='center'>%s</td>", $post['last_update']);
						printf("</tr>");
					}
					printf("</table><br>");
				}
				mysqli_free_result($result);
				mysqli_close($conn);
				
			?>
			<br>
			<a href="./index.php"><button>전체글 보기</button></a>
			<a href="./board_write.php"><button>글쓰기</button></a>
			<br>
		</div>
		<hr>
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>