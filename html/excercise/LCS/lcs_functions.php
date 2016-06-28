<?php 

	function make_diff_table($str1, $str2){

		$str1_arr = str_split($str1);
		$str2_arr = str_split($str2);

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
					echo "o";
				}else {
					echo " ";
				}
				printf("</td>");
			}
			printf("</tr>");
		}
		printf("</table>");
	}

	
	


?>