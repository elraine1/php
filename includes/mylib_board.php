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
		
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "SELECT * FROM board");
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($board = mysqli_fetch_assoc($result)){
			$board_info[$board['board_id']] = $board['board_name'];
		}
		
		mysqli_free_result($result);
		mysqli_close($conn);
		
		return $board_info;
	}
	
	// 게시판 ID(board_id)에 해당하는 모든 게시물을 출력해주는 함수.
	function get_posts($board_id, $start, $end){

		$i=0;
		$posts = array();
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, 
		"   SELECT *
			FROM (  SELECT @ROWNUM := @ROWNUM + 1 AS ROWNUM, post.* 
					FROM (SELECT @ROWNUM := 0) as R, post	
					WHERE board_id = ?
					ORDER BY post_id desc) as post
			WHERE ? < post.ROWNUM and post.ROWNUM < ?");
		
		mysqli_stmt_bind_param($stmt, "ddd", $board_id, $start, $end);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($post = mysqli_fetch_assoc($result)){
			$posts[$i]['post_id'] = $post['post_id'];
			$posts[$i]['writer'] = $post['writer'];
			$posts[$i]['title'] = $post['title'];
			$posts[$i]['content'] = $post['content'];
			$posts[$i]['hits'] = $post['hits'];
			$posts[$i]['last_update'] = $post['last_update'];
			$posts[$i]['comment_count'] = get_count_comment($post['post_id']);
			$i++;
		}
		
		mysqli_free_result($result);
		mysqli_close($conn);
		
		return $posts;
	}
	
	// 게시판 ID(board_id)에 해당하는 모든 게시물을 출력해주는 함수.
	function get_posts_by_search($board_id, $category, $search_word, $start, $end){

		$i = 0;
		$search_word = "%$search_word%";
		$posts = array();
		$conn = get_sqlserver_conn();

		/*
		$stmt = mysqli_prepare($conn, 
		"   SELECT *
			FROM (  SELECT @ROWNUM := @ROWNUM + 1 AS ROWNUM, post.* 
					FROM (SELECT @ROWNUM := 0) as R, post	
					WHERE board_id = ? and ? LIKE ?
					ORDER BY post_id desc) as post
			WHERE ? < post.ROWNUM and post.ROWNUM < ?; ");
		mysqli_stmt_bind_param($stmt, "dssdd", $board_id, $category, $search_word, $start, $end);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		*/
		
		
		$select_query = sprintf("
			SELECT *
			FROM (  SELECT @ROWNUM := @ROWNUM + 1 AS ROWNUM, post.* 
					FROM (SELECT @ROWNUM := 0) as R, post	
					WHERE board_id = %d and %s LIKE '%s'
					ORDER BY post_id desc) as post
			WHERE %d < post.ROWNUM and post.ROWNUM < %d; ",
			$board_id, $category, $search_word, $start, $end);
		$result = mysqli_query($conn, $select_query);
		
		
		while($post = mysqli_fetch_assoc($result)){
			$posts[$i]['post_id'] = $post['post_id'];
			$posts[$i]['writer'] = $post['writer'];
			$posts[$i]['title'] = $post['title'];
			$posts[$i]['content'] = $post['content'];
			$posts[$i]['hits'] = $post['hits'];
			$posts[$i]['last_update'] = $post['last_update'];
			$posts[$i]['comment_count'] = get_count_comment($post['post_id']);
			$i++;
		}
		
		mysqli_free_result($result);
		mysqli_close($conn);
		
		return $posts;
	}
	
			
	// post_id를 입력받아 post가 포함된 page 번호를 리턴해주는 함수.
	function get_page_by_post_id($board_id, $post_id){
		$page_size=20;

		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, 
		"   SELECT ROWNUM
			FROM (  SELECT @ROWNUM := @ROWNUM + 1 AS ROWNUM, post.* 
					FROM (SELECT @ROWNUM := 0) as R, post	
					WHERE board_id = ? 
					ORDER BY post_id desc) as post
			WHERE post_id = ?;");
		mysqli_stmt_bind_param($stmt, "dd", $board_id, $post_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$tmp = mysqli_fetch_assoc($result);
		$rownum = $tmp['ROWNUM'];
		$page = intval(($rownum-1) / $page_size) + 1;
					
		mysqli_free_result($result);
		mysqli_close($conn);
		return $page;
	}
		
	// post 개수를 리턴해주는 함수.
	function get_total_post($board_id){
		
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "SELECT count(*) as count FROM post WHERE board_id = ?;");
		mysqli_stmt_bind_param($stmt, "d", $board_id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$tmp = mysqli_fetch_assoc($result);
		$count = $tmp['count'];
		mysqli_free_result($result);
		mysqli_close($conn);
		return $count;
	}
	
	function get_total_post_by_search($board_id, $category, $search_word){
		
		$conn = get_sqlserver_conn();
		/*
		$search_word = "%$search_word%";
		$stmt = mysqli_prepare($conn, "SELECT count(*) as count FROM post WHERE board_id = ? and ? LIKE ?;");
		mysqli_stmt_bind_param($stmt, "dss", $board_id, $category, $search_word);
		mysqli_stmt_execute($stmt);
	
		$result = mysqli_stmt_get_result($stmt);
		*/
		
		$search_word = "%$search_word%";
		$select_query = sprintf("SELECT count(*) as count FROM post WHERE board_id = %d and %s LIKE '%s'", $board_id, $category, $search_word);
		$result = mysqli_query($conn, $select_query);
		
		$tmp = mysqli_fetch_assoc($result);
		$count = $tmp['count'];
		mysqli_free_result($result);
		mysqli_close($conn);
		return $count;
	}
	
	
	// post_id 에 딸려있는 댓글의 개수를 알려주는 함수. 
	function get_count_comment($post_id){
		
		$count = 0;
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "SELECT count(*) as count FROM comment where post_id = ?");
		mysqli_stmt_bind_param($stmt, "d", $post_id);
		mysqli_stmt_execute($stmt);
		if(($result = mysqli_stmt_get_result($stmt)) === false){
			die("Error updating record: " . mysqli_error($conn));
		}
		$tmp = mysqli_fetch_assoc($result);
		$count = $tmp['count'];
		return $count;
	}
	
	
	// 조회수 증가 함수.
	function update_hits($post_id){
		
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "UPDATE post SET hits=hits+1 WHERE post_id = ?;");
		mysqli_stmt_bind_param($stmt, "d", $post_id);
		
		if(!(mysqli_stmt_execute($stmt))){
			die("Error updating record: " . mysqli_error($conn));
		}
		mysqli_close($conn);
	}
	
	// 게시물 컨텐츠를 리턴해주는 함수.
	function get_post($post_id){
		
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "SELECT * FROM post WHERE post_id = ?");
		mysqli_stmt_bind_param($stmt, "d", $post_id);
		mysqli_stmt_execute($stmt);
		
		if (($result = mysqli_stmt_get_result($stmt)) === false) {
			die(mysqli_error($conn));
		}
		$post = mysqli_fetch_assoc($result);
		
		return $post;
	}
	
	// 게시물 작성해주는 함수.
	function post_upload($post){
				
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "INSERT INTO post(writer, title, content, board_id) 
										values(?, ?, ?, ?)");				
		mysqli_stmt_bind_param($stmt, "sssd", $post['writer'], $post['title'], $post['content'], $post['board_id']);
		if (mysqli_stmt_execute($stmt) === false) {
			die(mysqli_error($conn));
		}
		echo "성공적으로 작성되었습니다. <br>";	
		mysqli_close($conn);
	}
	
	// 게시물 수정 하는 함수.
	function modify_post($post){
		
		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "UPDATE post SET writer = ?, title = ?, content = ?, last_update = now() 
		WHERE post_id=?");	
		mysqli_stmt_bind_param($stmt, "sssd", $post['writer'], $post['title'], $post['content'], $post['post_id']); 
		
		if (mysqli_stmt_execute($stmt) === false) {
			die(mysqli_error($conn));
		}
		echo "성공적으로 수정되었습니다. <br>";
		mysqli_close($conn);
	}
	
	
	// 댓글 작성 함수.
	function comment_upload($comment){

		$conn = get_sqlserver_conn();
		$stmt = mysqli_prepare($conn, "INSERT INTO comment(post_id, writer, comment) VALUES(?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "dss", $comment['post_id'], $comment['writer'], $comment['comment']);	
		
		if (mysqli_stmt_execute($stmt) === false) {
			die(mysqli_error($conn));
		}
		printf("댓글 작성 완료! <br><br>");	
		printf("<a href='./index.php'><button>글목록</button></a><br>");
	}
	
	// 해당 게시글의 모든 댓글을 가져오는 함수. 
	function get_comments($post_id){	
//	function get_comments($post_id, $curr_block){		
		
		$i=0;
//		$block_size = 10;
//		$block_start = $curr_block * $block_size;
//		$block_end = $block_start + $block_size;
		
		$comments = array();
		
		$conn = get_sqlserver_conn();
		
		$stmt = mysqli_prepare($conn, "SELECT comment_id, writer, comment, written_date FROM comment 
		WHERE post_id = ?");						
		mysqli_stmt_bind_param($stmt, "d", $post_id);
		
		/*
		$stmt = mysqli_prepare($conn, 
		"   SELECT *
			FROM (  SELECT @ROWNUM := @ROWNUM + 1 AS ROWNUM, comment.* 
					FROM (SELECT @ROWNUM := 0) as R, comment	
					WHERE post_id = ?
					ORDER BY comment_id desc) as comment
			WHERE ? < comment.ROWNUM and comment.ROWNUM < ?");
		mysqli_stmt_bind_param($stmt, "ddd", $post_id, $block_start, $block_end);
		*/
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		if($result === false){
			die(mysqli_error($conn));
		}

		while($comment = mysqli_fetch_assoc($result)){
			$comments[$i]['comment_id'] = $comment['comment_id'];
			$comments[$i]['writer'] = $comment['writer'];
			$comments[$i]['comment'] = $comment['comment'];
			$comments[$i]['w_date'] = $comment['written_date'];
			$i++;
		}
		
		mysqli_free_result($result);
		mysqli_close($conn);
		return $comments;
	}

	
	
	
	// TIMEZONE 변경함수. UTC -> Asia/Seoul.
	function convert_time_string($time_string_from_db ) {
		$datetime = date_create($time_string_from_db , timezone_open('UTC'));
		$datetime = date_timezone_set($datetime, timezone_open('Asia/Seoul'));
		return date_format($datetime, 'Y-m-d H:i:s');
	}

	
	/// 더미게시물 생성.
	function make_dummy_post($conn, $count){
		
		for($i=0; $i<$count; $i++){
			
			$post['writer'] = "writer" . $i;
			$post['title'] = "title" . $i;
			$post['content'] = "content" . $i;
			$post['board_id'] = rand(1,2);
			
			$stmt = mysqli_prepare($conn, "INSERT INTO post(writer, title, content, board_id) VALUES(?, ?, ?, ?)");		
			mysqli_stmt_bind_param($stmt, "sssd", $post['writer'], $post['title'], $post['content'], $post['board_id']);
			if (mysqli_stmt_execute($stmt) === false) {
				die(mysqli_error($conn));
			}
		}
		
	}
	
?>
