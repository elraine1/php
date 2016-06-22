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
		
			function update_hits($conn, $bno){
				//$update_query = "UPDATE board SET hits=hits+1 WHERE bno='".$bno."';";	
				$update_query = sprintf("UPDATE board SET hits=hits+1 WHERE bno='%d'", $bno);
				if(!(mysqli_query($conn, $update_query))){
					echo "Error updating record: " . mysqli_error($conn);
				}
				//echo "Hits updated successfully!";
			}
			
			require_once('board_functions.php');
		
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$request_num = $_GET['bno'];
			}	
			
			$conn = get_mysql_conn();
			update_hits($conn, $request_num);
			
			$select_query = "SELECT * FROM board WHERE bno='".$request_num."';";
			$result = mysqli_query($conn, $select_query);// result_set
			if (($board = mysqli_query($conn, $select_query)) === false) {
				echo mysqli_error($conn);
			}
				
			$board = mysqli_fetch_assoc($result);
			
			echo "<table>";
			echo "<tr><th>BNO</th><td>" . $board['bno'] . "</td></tr>";
			echo "<tr><th>Writer</th><td>" . $board['writer'] . "</td></tr>";
			echo "<tr><th>Hits</th><td>" . $board['hits'] . "</td></tr>";
			echo "<tr><th>Date</th><td>" . $board['last_update'] . "</td></tr>";
			echo "<tr><th>Title</th><td>" . $board['title'] . "</td></tr>";
			echo "<tr><td height='10' colspan='2'></td></tr>";
			echo "<tr><th colspan='2' align='center'>Content</th></tr>";
			echo "<tr><td id='td_content' colspan='2'><textarea disabled rows='12' cols='135'>" . $board['content'] . "</textarea></td></tr>";
			echo "</table>";
			
					
			mysqli_free_result($result);
			mysqli_close($conn);
		?>	
		<br>
		<a href="./board_write.php"><button>글작성</button></a>
		<a href="./board_modify_form.php?bno=<?php echo $board['bno']?>"><button>글수정</button></a>
		<a href="./delete_process.php?bno=<?php echo $board['bno']?>"><button>글삭제</button></a><br>
		<a href="./index.php"><button>글목록</button></a><br>
	</div>
	<hr>
	
</body>
</html>