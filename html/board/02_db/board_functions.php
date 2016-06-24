<?php 

	function get_sqlserver_conn(){
		$hostname='kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
		$username='SeokMin';
		$password='password';
		$dbname='SeokMin';
		
		$conn=mysqli_connect($hostname, $username, $password, $dbname);
		mysqli_query($conn, "SET NAMES 'utf8'");
		if (!($conn)) {
			die('Mysql connection failed: '.mysqli_connect_error());
		} 
		return $conn;
	}

	// 게시판 id와 게시판 이름을 반환하는 함수로, board['id'] = name 형태의 배열로 리턴.
	function get_all_board_info(){
		
		$select_query = sprintf("SELECT * FROM board");
		
		$conn = get_sqlserver_conn();
		$result = mysqli_query($conn, $select_query);
		while($board = mysqli_fetch_assoc($result)){
			$board_info[$board['board_id']] = $board['board_name'];
		}
		
		mysqli_free_result($result);
		mysqli_close($conn);
		
		return $board_info;
	}
	
	// 조회수 증가 함수.
	function update_hits($post_id){
		
		$conn = get_sqlserver_conn();
		$update_query = sprintf("UPDATE post SET hits=hits+1 WHERE post_id='%d'", $post_id);
		if(!(mysqli_query($conn, $update_query))){
			echo "Error updating record: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
	
	// 게시물(post) 정보를 리턴해주는 함수.
	function get_post($post_id){
		
		$conn = get_sqlserver_conn();
		$select_query = "SELECT * FROM post WHERE post_id='".$post_id."';";
		$result = mysqli_query($conn, $select_query);// result_set
		if (($board = mysqli_query($conn, $select_query)) === false) {
			echo mysqli_error($conn);
		}
		$post = mysqli_fetch_assoc($result);
		
		return $post;
	}
	
	// 게시물 작성해주는 함수.
	function post_upload($board){
		// 작성자, 제목, 컨텐츠 중 내용이 하나라도 빠지면 die.
		echo "<br>";
		if($board['writer'] == '' || $board['title'] == '' || $board['content'] == '' ){
			echo "<br><a href='./board_write.php'><button>글쓰기</button></a>";
			echo "<a href='./index.php'><button>글목록</button></a> <br>";
			die('not enough data.');
		}
				
		$conn = get_sqlserver_conn();
		$insert_query = sprintf("INSERT INTO post(writer, title, content, board_id) values('%s', '%s', '%s', '%d')", $board['writer'], $board['title'], $board['content'], $board['board_id']);		
		if (mysqli_query($conn, $insert_query) === false) {
			die(mysqli_error($conn));
		}
	
		echo "성공적으로 작성되었습니다. <br>";
	}
	

	
	
	
?>
