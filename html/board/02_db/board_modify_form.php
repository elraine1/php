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

	<h1>나의 게시판</h1>
	<hr>
	<div class="content">	
		<?php
			require_once('board_functions.php');
		
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$request_num = $_GET['bno'];
			}	
			$conn = get_mysql_conn();
			
			$select_query = "SELECT * FROM board WHERE bno='".$request_num."';";
			$result = mysqli_query($conn, $select_query);// result_set
			if (($board = mysqli_query($conn, $select_query)) === false) {
				echo mysqli_error($conn);
			}
			
			$board = mysqli_fetch_assoc($result);
			
		?>
			<form action="modify_process.php" method="post">
				<table>
					<tr><th>BNO</th> <td><?php echo $board['bno']?></td></tr>
					<tr><th>Writer</th> <td><input type="text" name="board_writer" value="<?php echo $board['writer']?>"></td></tr>
					<tr><th>Hits</th> <td><?php echo $board['hits']?></td></tr>
					<tr><th>Date</th> <td><?php echo $board['last_update']?></td></tr>
					<tr><th>Title</th> <td><input type="text" name="board_title" value="<?php echo $board['title'] ?>"></td></tr>
					<tr><td height="10" colspan="2"></td></tr>
					<tr><th colspan="2" align="center">Content</th></tr>
					<tr><td id="td_content" colspan="2" align="center"><textarea name="board_content" rows="12" cols="135"><?php echo $board['content']?></textarea>
					<br><input type="submit"value="확인"></td></tr>
				</table>
			</form>
		<?php
			mysqli_free_result($result);
			mysqli_close($conn);
		?>	
		<a href="./board_write.php"><button>글작성</button></a>
		<a href="./index.php"><button>글목록</button></a> <br>
	</div>
	<hr>
	
</body>
</html>