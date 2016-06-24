<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style1.css">
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
				$board_id = $_GET['board_id'];
			}	
			
			$board_info = get_all_board_info();
			$post = get_post($post_id);
			update_hits($post_id);
		
			printf("<table>");
			printf("<tr><th colspan='2'>%s 게시판</th></tr>", $board_info[$board_id]);
			printf("<tr><th>글번호</th><td>%d</td></tr>", $post['post_id']);
			printf("<tr><th>작성자</th><td>%s</td></tr>", $post['writer']);
			printf("<tr><th>조회수</th><td>%d</td></tr>",$post['hits']);
			printf("<tr><th>작성일</th><td>%s</td></tr>",$post['last_update']);
			printf("<tr><th>제목</th><td>%s</td></tr>", $post['title']);
			printf("<tr><td height='10' colspan='2'></td></tr>");
			printf("<tr><th colspan='2' align='center'>내 용</th></tr>");
			printf("<tr><td id='td_content' colspan='2'><textarea disabled rows='12' cols='135'>%s</textarea></td></tr>", $post['content']);
			printf("</table>");
			printf("<br><a href='./post_write_form.php?board_id=%d'><button>글작성</button></a>", $board_id);
			printf("<a href='./post_modify_form.php?board_id=%d&post_id=%d'><button>글수정</button></a>", $board_id, $post['post_id']);
			printf("<a href='./post_delete_process.php?post_id=%d'><button>글삭제</button></a><br>", $post['post_id']);
			
		?>	
	</div>
	<div class="comment_wrap">
		<br>
		<b>Comments(...)</b>
		<div class="comment">
			<table>
				<tr>
					<td class="user_id" height="20">123</td><td class="comment">456789</td><td class="date">000</td>
				</tr>
			</table>
		</div>
		<div class="comment_form">
			<form action="" method="post">
				<?php printf("<input type='hidden' value='%d'>", $post_id); ?>
				<table width="800px">
					<tr>
						<td class="user_id" align="center" width="60px">WRITER:<br><input type="text" name="writer" size="14"></td>
						<td class="comment" align="center" width="200px"><textarea name="comment" rows="4" cols="70"></textarea></td>
						<td><input type="submit" value="확인" align="center"></td>
					</tr>						
				</table>
			</form>				
		</div>
	</div>
		<a href="./index.php"><button>글목록</button></a><br>
	<hr>
	
</body>
</html>