<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<head>
	<title>Hello, World!</title>
  
</head>

<body>  
	 
	<div class="wrap">
		<h2>Diff Checker</h2>
		<hr>
					
			<?php
				require_once('diff_lib.php');
				
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$txt1 = $_POST['txt1'];
					$txt2 = $_POST['txt2'];
				}

				printf("<table>");
				printf("<tr><th>TEXT1</th><th></th><th>TEXT2</th></tr>");
				printf("<tr>");
				printf("<td><textarea rows='30' cols='80' name='txt1'>%s</textarea></td>", $txt1);
				printf("<td width='40'></td>");
				printf("<td><textarea rows='30' cols='80' name='txt2'>%s</textarea></td>", $txt2);
				printf("</tr>");
				printf("<tr><td colspan='3' align='center'><a href='#'><button>다시 하기</button></a></td></tr>");
				printf("</table>");
		
				$txt_diff_matrix = make_diff_table($txt1, $txt2);

				$lcs_matrix = init_lcs_matrix($txt_diff_matrix);
				$end_row = count($lcs_matrix)-1;
				$end_col = count($lcs_matrix[0])-1;
				
				for($i = $end_row-1 ; $i >= 0 ; $i--){
					
					for($j = $end_col-1 ; $j >= 0; $j--){
						if($lcs_matrix[$i][$j] == "v"){
							
							$submatrix = make_submatrix($lcs_matrix, $i+1, $j+1);	
							$max_in_submatrix = get_max_in_matrix($submatrix);
							$lcs_matrix[$i][$j] = $max_in_submatrix + 1;
						}
					}
				}
				
				$txt1_lines = explode("\r\n", $txt1);
				$txt2_lines = explode("\r\n", $txt2);
				
				printf("<h4>Route Table</h4>");
				printf("<table>");
				printf("<tr>");
				printf("<th>＼</th>");
				for($i=0 ; $i < count($txt1_lines); $i++){
					printf("<th> txt1_%d </th>", $i+1);
				}
				printf("</tr>");

				for($i=0 ; $i < count($txt2_lines); $i++){			
					printf("<tr>");
					printf("<th> txt2_%d </th>", $i+1);
					
					for($j=0 ; $j < count($txt1_lines); $j++){
						printf("<td>");
						printf("<input type='text' size='1' value='%s'>", $lcs_matrix[$i][$j]);
						printf("</td>");
					}
					printf("</tr>");
				}
				printf("</table>");
				printf("<hr>");
				
				$lcs = array();
				$find = get_max_in_matrix($lcs_matrix);
				$start_j = 0;	
				$key_idx = 0;
				echo join(" ",$txt1_lines);
				for($i=0; $i <= $end_row; $i++){

					for($j = $start_j ; $j <= $end_col; $j++){
						if($lcs_matrix[$i][$j] === $find){
							$lcs[$key_idx++] = sprintf("(%d,%d)", $i, $j);
							$lcs2[$j][$i] = $txt1_lines[$j];
							$start_j = $j+1;		// column 탐색 시작점 변경. 
							$find--;	
							break; 
						}
					}
					if($find==0){ break; }	// $find가 0이면 더이상 찾을 값이 없으므로 종료.
				}
				
				echo "<br>LCS : " . join("/", $lcs) . "<br><br>";
				
				$lcs2_keys = array_keys($lcs2);
				print_r($lcs2_keys);
				for($i=0; $i<count($lcs2_keys); $i++){
					echo $txt1_lines[$lcs2_keys[$i]] . "/";
				}
				
			?>
					
		<hr>
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>
</body>

  
</html>
