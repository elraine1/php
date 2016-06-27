<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style/style1.css">
</head>
<body>
	<h1>POST 수정하기</h1>
	<div class="content">	
		<?php
			$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
			require_once($mylib_path);
			
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$post_id = $_GET['post_id'];
			}	
			
			$board_info = get_all_board_info();
			$post = get_post($post_id);		
		
			printf("<h3>%s 게시판</h3>", $board_info[$post['board_id']]);
			printf("<hr>");
			printf("<form action='post_modify_process.php' method='post'>");
			printf("<input type='hidden' name='post_id' value='%d'>", $post['post_id']);
			printf("<table>");
			printf("<tr><th>글번호</th> <td>%d</td></tr>", $post['post_id']);
			printf("<tr><th>작성자</th> <td><input type='text' name='writer' value='%s'></td></tr>", $post['writer']);
			printf("<tr><th>조회수</th> <td>%d</td></tr>", $post['hits']);
			printf("<tr><th>작성일</th> <td>%s</td></tr>", $post['last_update']);
			printf("<tr><th>제목</th> <td><input type='text' name='title' value='%s'></td></tr>",  $post['title'] );
			printf("<tr><td height='10' colspan='2'></td></tr>");
			printf("<tr><th colspan='2' align='center'>내 용</th></tr>");
			printf("<tr><td id='td_content' colspan='2' align='center'><textarea name='content' rows='12' cols='135'>%s</textarea>", $post['content']);
			printf("<br><input type='submit' value='확인'></td></tr>");
			printf("</table>");
			printf("</form>");
			
			printf("<br><a href='./post_write_form.php'><button>글쓰기</button></a>");
			printf("<a href='./index.php'><button>글목록</button></a><br>");
			
		?>
	</div>
	<hr>
	
</body>
</html>