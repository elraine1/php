<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<script language="javascript" src="./jquery/jquery-1.11.2.js"></script>
	<script language="javascript" src="./jquery/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="/php_style/style1.css">
	<style type="text/css">
		table{
			width:60%;
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
		a{
			text-decoration: none;
		}
		#more_comment_btn{
			text-align:center;
			width:400px;
		}
	</style>
		
	<script>
	var isEditCommentMode = false;
	function editComment(button, commentId, form) {
		var cell = document.getElementById(commentId);
		if (isEditCommentMode == false) {
			var content = cell.innerHTML;
			cell.innerHTML = '';
			var textarea = document.createElement('textarea');
			textarea.id = commentId + 'textarea';
			cell.appendChild(textarea);
			textarea.value = content;
			textarea.cols = 60;
			isEditCommentMode = true;
			button.value = '수정완료';
		} else {
			var textarea = document.getElementById(commentId + 'textarea');
			var content = textarea.value;
			if (content == '') {
				alert('댓글은 빈칸 안됨');
				textarea.focus();
				return false;
			}
			//cell.innerHTML = content;
			isEditCommentMode = false;
			button.value = '수정';
		
/*		
			var element = document.createElement('input');
			form.appendChild(element);
			element.name = 'content';
			element.type = 'hidden';
			element.value = content;			
			form.submit();
			alert(commentId);
			alert(content);
*/			
			
			$.ajax({
				url: 'edit_comment.php',
				async: false,
				method: 'POST',
				data: {
					comment_id: commentId,
					content: content
				},
				success: function(result){
					// textarea => span 
					
				},
				error: function(xhr){
					alert('Error');
				},
				timeout : 3000
			});
			
		}
		return false;
	}
	
	
	</script>
</head>
<body>
	<?php		
		$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
		$login_bar_path = $_SERVER['DOCUMENT_ROOT'] . '/board/03_login/user/login_header.php';
	
		require_once($mylib_path);
		require_once($login_bar_path);
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$post_id = $_GET['post_id'];
			$board_id = $_GET['board_id'];
		}	

	?>
	
	<h2>글 보기</h2>
	<hr>
	<div class="content">	
		<?php

			$board_info = get_all_board_info();
			$post = get_post($post_id);
			update_hits($post_id);
			printf("<h3><a href='./board_list.php?board_id=%d&page=1'>%s 게시판</a></h3>", $board_id, $board_info[$board_id]);
		
			printf("<table>");
			printf("<tr><th colspan='2'>%s 게시판</th></tr>", $board_info[$post['board_id']]);
			printf("<tr><th>글번호</th><td>%d</td></tr>", $post['post_id']);
			printf("<tr><th>작성자</th><td>%s</td></tr>", $post['writer']);
			printf("<tr><th>조회수</th><td>%d</td></tr>",$post['hits']);
			printf("<tr><th>작성일</th><td>%s</td></tr>",convert_time_string($post['last_update']));
			printf("<tr><th>제목</th><td>%s</td></tr>", htmlspecialchars($post['title']));
			printf("<tr><td height='10' colspan='2'></td></tr>");
			printf("<tr><th colspan='2' align='center'>내 용</th></tr>");
			printf("<tr><td id='td_content' colspan='2'><textarea disabled rows='12' cols='150'>%s</textarea></td></tr>", htmlspecialchars($post['content']));
			printf("</table>");
			
			printf("<br><a href='./board_list.php?board_id=%d&page=%d'><button>글목록으로</button></a>", $post['board_id'], get_page_by_post_id($post['board_id'], $post['post_id']));
			printf("<a href='./post_write_form.php?board_id=%d'><button>글작성</button></a>", $post['board_id']);
			
			if(isset($_SESSION['login_status']) && ($_SESSION['login_status']===true) && ($_SESSION['nickname'] == $post['writer'])){
				printf("<a href='./post_modify_form.php?post_id=%d'><button>글수정</button></a>", $post['post_id']);
				printf("<a href='./post_delete_process.php?board_id=%d&post_id=%d'><button>글삭제</button></a><br>", $post['board_id'], $post['post_id']);
			}
			
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
					printf("<tr>");
					printf("<td class='user_id' height='20' width='130'> %s </td>", $comments[$i]['writer']);
					printf("<td class='comment' width='720' id='%d'>%s</td>", $comments[$i]['comment_id'], htmlspecialchars($comments[$i]['comment']));
					printf("<td class='date'> %s </td>",convert_time_string($comments[$i]['w_date']));
					
					if (check_login() && $_SESSION['nickname'] === $comments[$i]['writer']) {
		?>
						<td>
							<form action="comment_modify_process.php" method="post">
							<input type="button" value="수정" style="width: 50px;" onclick="editComment(this, <?php echo $comments[$i]['comment_id']; ?>, this.form);"> </input>
							<input type="hidden" name="comment_id" value="<?php echo $comments[$i]['comment_id']; ?>"></input>
							</form>
						</td>
						<td><form action="comment_delete_process.php" method="post">
							<input type="submit" value="삭제" style="width: 50px;"> </input>
							<input type="hidden" name="comment_id" value="<?php echo $comments[$i]['comment_id']; ?>"></input>
						</form></td>
		<?php
					}
					printf("</tr>");
				}
				
				printf("</table>");
				printf("</div>");
			} 
		?>
		
		<div class="comment_form">
			<input type="button"  id="more_comment_btn" value="댓글 더 보기" onclick="#">
			<form action="comment_write_process.php" method="post">
				<?php printf("<input type='hidden' name='post_id' value='%d'>", $post_id); ?>
				<table width="800px">
					<tr>
						<td class="user_id" align="center" width="60px">WRITER:<br>
							<?php 
								if(isset($_SESSION['login_status']) && $_SESSION['login_status'] === true){
									printf("<input type='text' name='writer' size='14' value='%s' readonly>", $_SESSION['nickname']);
								}else{
									printf("<input type='text' name='writer' size='14' value='로그인 후 작성 가능' disabled>");
								}
							?>
						</td>
						<td class="comment" align="center" width="200px">
						<?php 
							if(isset($_SESSION['login_status']) && $_SESSION['login_status'] === true){
								printf("<textarea name='comment' rows='4' cols='100'></textarea>");
							}else{
								printf("<textarea name='comment' rows='4' cols='100' disabled>로그인 후 작성 가능</textarea>");
							}
						?>
						</td>
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