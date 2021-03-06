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
		<div id="div_table">
		
			<?php	
				$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
				require_once($mylib_path);
				
				$board_info = get_all_board_info();
				
				printf("<ul>");
				foreach($board_info as $board_id => $board_name){		// 게시판 리스트(링크) 출력
					printf("<li><h3><a href='board_list.php?board_id=%d&page=1'>%s 게시판</a></h3></li>", $board_id, $board_name);
				}
				printf("</ul>");
			?>
			<a href="./index.php"><button>홈으로</button></a>
			<br>
		</div>
		<hr>	
		<?php 
			printf("<a href='make_dummy.php'><button>더미 생성</button></a>");
		?>
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>	

</body>
</html>