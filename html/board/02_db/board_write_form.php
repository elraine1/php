<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<style type="text/css">
	table {
		width: 50%;
		align: center;
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
		margin: 10px;
	}
	th {
		width: 50px;
		background-color: LightSkyBlue ;
		border: 1px solid LightSeaGreen;
	}
	td, tr {
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
	}
	.input_text {
		 height: 30px;
	}
	</style>
</head>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$board_id = $_GET['board_id'];
	}	
?>

<body>
	<div class="content">
		<h1>나의 게시판</h1>
		<hr>
		<form action="write_process.php" method="post">
			<?php printf("<input type='hidden' name='board_id' value='%s'>", $board_id);	?>
			<table>
				<tr>
					<th><h5>작성자</h5></th>
					<td><input type="text" class="input_text" name="writer"></td>
				</tr>
				<tr>
					<th><h5>제목</h5></th>
					<td><input type="text" class="input_text" name="title"></td>
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