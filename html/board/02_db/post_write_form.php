<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style/style1.css">
</head>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$board_id = $_GET['board_id'];
	}		
	
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	require_once($mylib_path);
	
	$board_info = get_all_board_info();
?>

<body>
	<div class="content">
	<?php 
		printf("<h1>%s 게시판</h1>", $board_info[$board_id]);
	?>
		<hr>
		<form action="post_write_process.php" method="post">
			<?php printf("<input type='hidden' name='board_id' value='%s'>", $board_id); ?>
			<table>
				<tr>
					<th><h5>작성자</h5></th>
					<td><input type="text" class="input_text" name="writer"></td>
				</tr>
				<tr>
					<th><h5>제목</h5></th>
					<td><input type="text" class="input_text" name="title" size='78'></td>
				</tr>
				<tr>
					<th><h5>내용</h5></th>
					<td><textarea name="content" rows="20" cols="80"></textarea></td>		<!-- javascript로 new line 처리?? -->
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="제출">
					</td>
				</tr>
			</table>
		</form>
		<a href="./index.php"><button>전체글 보기</button></a> <br>
		<hr>
	</div>

</body>
</html>