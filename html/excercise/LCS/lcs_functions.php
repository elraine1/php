<?php 
	// DIFF Table 작성.	
	function make_diff_table($str1, $str2){

		$str1_arr = str_split($str1);
		$str2_arr = str_split($str2);
		$lcs_matrix = array();

		printf("<hr>");
		printf("<h4>Diff Table</h4>");

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
				
				if(strcmp($str2_arr[$i], $str1_arr[$j])==0){
					$lcs_matrix[$i][$j] = "v";
				}else {
					$lcs_matrix[$i][$j] = "0";
				}
				printf("<input type='text' size='1' value='%s'>", $lcs_matrix[$i][$j]);
				printf("</td>");
			}
			printf("</tr>");
		}
		printf("</table>");
		
		return $lcs_matrix;
	}

	// lcs_matrix  초기화.
	function init_lcs_matrix($diff_matrix){
		
		$lcs_matrix = $diff_matrix;
		$end_row = count($diff_matrix)-1;
		$end_col = count($diff_matrix[0])-1;
		
		for($i = $end_row; $i >= 0; $i--){
			if($diff_matrix[$i][$end_col] == "v"){
				$lcs_matrix[$i][$end_col] = 1;
			}else{
				$lcs_matrix[$i][$end_col] = 0;
			}
		}
		
		for($i = $end_col; $i >= 0; $i--){
			if($diff_matrix[$end_row][$i] == "v"){
				$lcs_matrix[$end_row][$i] = 1;
			}else{
				$lcs_matrix[$end_row][$i] = 0;
			}
		}
		
		return $lcs_matrix;
	}
	
	// submatrix 생성함수.
	function make_submatrix($lcs_matrix, $i, $j){
		
		$end_row = count($lcs_matrix)-1;
		
		$submatrix = array();
		
		while($end_row >= $i){
			$submatrix[] = array_slice($lcs_matrix[$i], $j);
			$i++;
		}
		return $submatrix;
	}
			
			
	// matrix 내에서 가장 큰 값 찾기.
	function get_max_in_matrix($submatrix){
		
		$max = 0;
		$rows = count($submatrix);
		$cols = count($submatrix[0]);
		for($i=0; $i < $rows; $i++){
			for($j=0; $j < $cols; $j++){
				if($max < $submatrix[$i][$j]){
					$max = $submatrix[$i][$j];
				}
			}
		}
		return $max;
	}
			
	
			
			
	
	
?>