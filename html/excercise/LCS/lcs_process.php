<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<head>
	<title>Hello, World!</title>

	<style type="text/css">
		
		th{
			background-color: gray;
		}
		
		table, td, th{
			border: 1px solid blue;
		}
	</style>
	
</head>


<body>  
	 
	<div class="wrap">
		<h2>Longest Common Subsequence Test</h2>
		<hr>
	
		<?php
			require_once("lcs_functions.php");
		
			if($_SERVER['REQUEST_METHOD'] == 'GET'){		
				$str1 = $_GET['str1'];
				$str2 = $_GET['str2'];
			}
			echo "str1: " . $str1 . "<br>";
			echo "str2: " . $str2 . "<br><br>";
			
			$str_diff_matrix = make_diff_table($str1, $str2);
			
			echo "<hr>";
			///////////////////////////////
			
			$lcs_matrix = init_lcs_matrix($str_diff_matrix);
			
			
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
				
			$str1_arr = str_split($str1);
			$str2_arr = str_split($str2);
				
			printf("<h4>Route Table</h4>");
			printf("<table>");
			printf("<tr>");
			printf("<th>＼</th>");
			for($i=0 ; $i < count($str1_arr); $i++){
				printf("<th> %s </th>", $str1_arr[$i]);
			}
			printf("</tr>");

			for($i=0 ; $i < count($str2_arr); $i++){			
				printf("<tr>");
				printf("<th> %s </th>", $str2_arr[$i]);
				
				for($j=0 ; $j < count($str1_arr); $j++){
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
			for($i=0; $i <= $end_row; $i++){

				for($j = $start_j ; $j <= $end_col; $j++){
					if($lcs_matrix[$i][$j] === $find){
						$lcs[] = $str1_arr[$j];			
						$start_j = $j+1;		// column 탐색 시작점 변경. 
						$find--;	
						break; 
					}
				}
				if($find==0){ break; }	// $find가 0이면 더이상 찾을 값이 없으므로 종료.
			}
			
			echo "<br>LCS : " . join(" ", $lcs) . "<br><br>";
			
		?>	
	
		<a href="./lcs_index.php"><button>다시하기</button></a><br>
		<a href="/index.php"><button>홈으로</button></a><br>
	</div>
</body>

 
</html>