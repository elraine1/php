<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style/style1.css">
</head>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$board_id = $_GET['board_id'];
		$page = $_GET['page'];
	}		
	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
	
?>

<body>
	<div class="content">
	<h2>글 목록</h2>
	<?php 
		$board_info = get_all_board_info();
		$posts = get_posts($board_id, $page);

		printf("<hr>");
		printf("<h3>%s 게시판</h3>", $board_info[$board_id]);
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
		
		//// 페이징.
		
		$page_size = 20; 
		$total_post = get_total_post($board_id);
		$total_page = ($total_post - 1) / $page_size + 1;

		$block_size = 10;
		$curr_block = intval(($page - 1) / $block_size) + 1;
		$block_start = ($curr_block - 1) * $block_size + 1;
		$block_end = $block_start + $block_size;
		
		if($block_end > $total_page){
			$block_end = $total_page;
		}

		if($block_start == 1){
			printf("[이전]");
		}else{
			printf("[<a href='./board_list.php?board_id=%d&page=%d'>이전</a>]", $board_id, $block_start-1);
		}
		
		for($i = $block_start ; $i < $block_end ; $i++){
			if($i == $page){
				printf("[<b>%d</b>]", $i);
			}else {
				printf("[<a href='board_list.php?board_id=%d&page=%d'>%d</a>]", $board_id, $i, $i);
			}
		}
		
		if($block_end == $total_page){
			printf("[다음]");
		}else{
			printf("[<a href='./board_list.php?board_id=%d&page=%d'>다음</a>]", $board_id, $block_end);
		}
		
		
		printf("<br><a href='./post_write_form.php?board_id=%d'><button>글쓰기</button></a><br><br>", $board_id);
			
	?>
		<hr>
		<a href="./index.php"><button>홈으로</button></a> <br>
		<hr>
	</div>

</body>
</html>
				