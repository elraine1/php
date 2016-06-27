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
				$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
				require_once($mylib_path);
				
				$board_info = get_all_board_info();				
				foreach($board_info as $board_id => $board_name){		// 게시판별 테이블 작성.
					printf("<hr>");
					printf("<h3>%s 게시판</h3>", $board_name);
					
					$posts = get_posts($board_id);
					
					printf("<table>");
					printf("<tr> <th width='40'>글번호</th> <th width='80'>작성자</th> <th width='200'>제목</th> <th width='40'>조회수</th> <th width='90'>작성일시</th></tr>");
					
					for($i=0; $i < count($posts); $i++){
						printf("<tr>");
						printf("<td id='td_num' align='center'><a href='./view_post.php?post_id=%d'>%d</a></td>", $posts[$i]['post_id'], $posts[$i]['post_id']);
						printf("<td align='center'>%s</td>", $posts[$i]['writer']);
						
						if($posts[$i]['comment_count'] > 0){
							printf("<td align='left'><a href='./view_post.php?post_id=%d'> %s <b>[%d]</b></td>", $posts[$i]['post_id'],$posts[$i]['title'], $posts[$i]['comment_count']);
						}else{
							printf("<td align='left'><a href='./view_post.php?post_id=%d'> %s </td>", $posts[$i]['post_id'],$posts[$i]['title']);
						}
						
						printf("<td align='center'>%d</td>", $posts[$i]['hits']);
						printf("<td align='center'>%s</td>", convert_time_string($posts[$i]['last_update']));
						printf("</tr>");
					}

					printf("</table>");	
					printf("<a href='./post_write_form.php?board_id=%d'><button>글쓰기</button></a><br><br>", $board_id);
					

				}
				
			?>
			<a href="./index.php"><button>전체글 보기</button></a>
			<br>
		</div>
		<hr>
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>