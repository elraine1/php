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
			printf("<br><a href='./board_write_form.php?board_id=%d'><button>글작성</button></a>", $board_id);
			
		?>	

		<a href="./board_modify_form.php?post_id=<?php echo $post['post_id']?>"><button>글수정</button></a>
		<a href="./delete_process.php?post_id=<?php echo $post['post_id']?>"><button>글삭제</button></a><br>
		<a href="./index.php"><button>글목록</button></a><br>
	</div>
	<hr>
	
</body>
</html>