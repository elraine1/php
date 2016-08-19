<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/php_style/style1.css">
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
		a{
			text-decoration: none;
		}
	</style>
</head>

<?php
	$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
	$login_bar_path = $_SERVER['DOCUMENT_ROOT'] . '/board/04_ajax/user/login_header.php';
	
	require_once($mylib_path);
	require_once($login_bar_path);

	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$board_id = $_GET['board_id'];
	}	
	$board_info = get_all_board_info();
?>
	
<body>
	<div class="content">
	<?php 
		printf("<h1>%s 게시판</h1>", $board_info[$board_id]);
		
		if(isset($_SESSION['login_status'])&& ($_SESSION['login_status'] === true)){
	?>
		<hr>
		<form action="post_write_process.php" method="post">
			<?php printf("<input type='hidden' name='board_id' value='%s'>", $board_id); ?>
			<table>
				<tr>
					<th><h5>작성자</h5></th>
					<td><input type="text" class="input_text" name="writer" value="<?php echo $_SESSION['nickname']?>" readonly></td>
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
		
	<?php
		}
		
		printf("<br>");
		printf("<a href='./board_list.php?board_id=%d&page=1'><button>글목록</button></a>", $board_id);
		printf("<a href='./index.php'><button>홈으로</button></a>");
		printf("<br>");
	?>
		<hr>
	</div>

</body>
</html>