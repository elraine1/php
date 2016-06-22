<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<style type="text/css">
	#wrap{
		margin: 0 auto;
	}
	table{
		width: 60%;
		align: center;
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
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
		text-align: center;
	}
	a{
		text-decoration: none;
	}
	
	#div_table{
		margin: 0 auto;
		width: 100%;
	}
	
	#div_search{
		width: 60%;
		text-align: right;
		margin: 0;
	}
</style>
<body>
	<div id="wrap">
		
		<h2>게시판 연습</h2>
		<hr>
		<div id="div_table">
			<h3>글 목록</h3>				
			<?php	
				require_once('board_functions.php');
				
				$conn = get_sqlserver_conn();
				$select_query = "SELECT * FROM board ORDER BY bno DESC";
				// select 쿼리는 mysqli_query 함수의 반환값으로 결과를 받는다.
				
				$search_type="";
				$search_word="";
				if($_SERVER['REQUEST_METHOD'] == 'GET'){				
					if(isset($_GET['search_type']) && isset($_GET['search_word'])){
						$search_type = $_GET['search_type'];
						$search_word = $_GET['search_word'];
						
						if($search_word != null){
							$select_query = "SELECT * FROM board WHERE " . $search_type . " LIKE '%" . $search_word . "%' ORDER BY bno DESC";
						}
					}
				}
				
				$result = mysqli_query($conn, $select_query);
		
				echo "<table>";
				echo "<tr> <th width='40'>BNO</th> <th width='80'>Writer</th> <th width='200'>Title</th> <th width='40'>Hits</th> <th width='90'>Date</th></tr>";
				while($board = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td id='td_num' align='center'><a href='./view_content.php?bno=" . $board['bno'] . "'> " . $board['bno'] . "</a></td>";
					echo "<td align='center'> " . $board['writer'] . " </td>";
					echo "<td align='left'><a href='./view_content.php?bno=" . $board['bno'] . "'> " . $board['title'] . "</a></td>";
					echo "<td align='center'> " . $board['hits'] . " </td>";
					echo "<td align='center'> " . $board['last_update'] . " </td>";
					echo "</tr>";	
				}
				echo "</table>";
				
				mysqli_free_result($result);
				mysqli_close($conn);
				
			?>
				<div id="div_search">
					<form action="index.php" method="get">
						<select name="search_type">
							<option value="title">제목</option>
							<option value="writer">작성자</option>
						</select>
						<input type="text" name="search_word" width="80">
						<input type="submit" value="검색"><br>
					</form>
				</div>
				
			<br>
			<a href="./index.php"><button>전체글 보기</button></a>
			<a href="./board_write.php"><button>글쓰기</button></a>
			<br>
		</div>
		<hr>
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>