<?php 
	// 글 작성시 등록될 게시물번호를 알려주는 함수(등록된 글번호의 최대값+1을 반환). 
	function get_board_num($lines){
		
		$max_num = 0;
		for($i=0; $i < count($lines); $i++){
			$board_info = explode("\t", $lines[$i]);
			if (count($board_info) === 4) {
				if($max_num < $board_info[0]){		// board_info[0] = board_num(게시글 번호)
					$max_num = $board_info[0];
				}
			} else { // error
				die('count was'.count($board_info).' Error occured!');
			}
		}	
		return $max_num+1;
	}

	// writeform으로부터 입력받은 내용들을 하나의 문자열로 변환해주는 함수.
	function make_string_from_writeform($lines){
		
		$board_info = array();
		$board_info[0] = get_board_num($lines);			// board_number
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$board_info[1] = $_POST['board_writer'];	// board_writer
			$board_info[2] = $_POST['board_title'];		// board_title
			$board_info[3] = $_POST['board_content'] . "\n";// board_content
		}
		
		$result = implode("\t", $board_info);
		return $result;
	}
	
	// data file에 쓰는 함수. 
	function write_to_file($file_name, $line){	
		
		$file_name = './board.txt';
		$file_handle = fopen($file_name, 'a');
		
		if(!$file_handle){
			die('file could not be opened!');
		}
		
		if(fwrite($file_handle, $line) !== false){
			echo '게시글 작성 완료!<br>';
		}else{
			die('게시글 작성 실패ㅜㅜ!<br>');
		}
		
		fclose($file_handle);
	}
	
	// 하나의 라인으로부터 explode를 이용하여 게시판 내용을 나누어 반환하는 함수 
	function get_board_content($line){
		
		$board = array();
		$board_info = explode("\t", $line);
		if (count($board_info) === 4) {	
			$board['number'] = $board_info[0];
			$board['writer'] = $board_info[1];
			$board['title'] = $board_info[2];
			$board['content'] = $board_info[3];
		} else { // error
			die('count was'.count($board_info).' Error occured!');
		}
		return $board;
	}
	
	// data.txt 파일의 모든 라인을 받아 배열로 반환해주는 함수.
	function get_lines($file_name){
		
		$file_handle = fopen($file_name, 'r');
		if (!$file_handle) {
			die('file could not be opened!');
		}
		
		$lines = array();
		while(($line=fgets($file_handle)) !== false){
			$lines[] = $line;
		}			
		
		fclose($file_handle);
		return $lines;
	}

	// lines의 전체 내용을 출력해주는 함수. 
	function print_board_to_table_list($lines){
		
		$board = array();
		echo "<table>";
		echo "<tr><td>번호</td><td>작성자</td><td>제목</td></tr>";
		for($i=0; $i < count($lines); $i++){
			
			$board = get_board_content($lines[$i]);
			
			echo "<tr>";
			echo "<td> <a href='./view_content.php?boardnum=" . $board['number'] . "'> " . $board['number'] . " </td>";
			echo "<td> " . $board['writer'] . " </td>";
			echo "<td> <a href='./view_content.php?boardnum=" . $board['number'] . "'> " . $board['title'] . " </a> <td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	// 메인페이지로 이동하는 링크 출력. 
	function link_goto_main(){
		echo "<br><a href='/index.php'>main으로</a><br>";
	}

?>
