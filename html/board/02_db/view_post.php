<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style/style1.css">
</head>
<body>

	<h1>POST</h1>
	<hr>
	<div class="content">	
		<?php
		
			$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
			require_once($mylib_path);
			
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$post_id = $_GET['post_id'];
			}	
			
			$board_info = get_all_board_info();
			$post = get_post($post_id);
			update_hits($post_id);
		
			printf("<table>");
			printf("<tr><th colspan='2'>%s 게시판</th></tr>", $board_info[$post['board_id']]);
			printf("<tr><th>글번호</th><td>%d</td></tr>", $post['post_id']);
			printf("<tr><th>작성자</th><td>%s</td></tr>", $post['writer']);
			printf("<tr><th>조회수</th><td>%d</td></tr>",$post['hits']);
			printf("<tr><th>작성일</th><td>%s</td></tr>",convert_time_string($post['last_update']));
			printf("<tr><th>제목</th><td>%s</td></tr>", $post['title']);
			printf("<tr><td height='10' colspan='2'></td></tr>");
			printf("<tr><th colspan='2' align='center'>내 용</th></tr>");
			printf("<tr><td id='td_content' colspan='2'><textarea disabled rows='12' cols='135'>%s</textarea></td></tr>", $post['content']);
			printf("</table>");
			printf("<br><a href='./post_write_form.php?board_id=%d'><button>글작성</button></a>", $post['board_id']);
			printf("<a href='./post_modify_form.php?post_id=%d'><button>글수정</button></a>", $post['post_id']);
			printf("<a href='./post_delete_process.php?post_id=%d'><button>글삭제</button></a><br>", $post['post_id']);
			
			$comments = get_comments($post_id);
		?>	
	</div>
	<div class="comment_wrap">
		<br><br>
		<?php 
			printf("총 <b>%d</b> 건의 댓글이 있습니다.", count($comments));
		
			if( count($comments) > 0){ 
				printf("<div class='comment'>");
				printf("<table>");
				
				for($i=0; $i < count($comments); $i++){
					printf("<tr><td class='user_id' height='20' width='130'> %s </td><td class='comment' width='600'> %s </td><td class='date'> %s </td></tr>", 
							$comments[$i]['writer'], $comments[$i]['comment'], convert_time_string($comments[$i]['w_date']));
				}
				printf("</table>");
				printf("</div>");
			} 
		?>
		
		<div class="comment_form">
			<form action="comment_write_process.php" method="post">
				<?php printf("<input type='hidden' name='post_id' value='%d'>", $post_id); ?>
				<table width="800px">
					<tr>
						<td class="user_id" align="center" width="60px">WRITER:<br><input type="text" name="writer" size="14"></td>
						<td class="comment" align="center" width="200px"><textarea name="comment" rows="4" cols="100"></textarea></td>
						<td><input type="submit" value="확인" align="center"></td>
					</tr>						
				</table>
			</form>				
		</div>
	</div>
		<a href="./index.php"><button>홈으로</button></a><br>
	<hr>
	
</body>
</html>