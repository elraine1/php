<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>단어사전 순위 검색</h2>

	<?php 
		$file_name = './dictionary.txt';
		$file_handle = fopen($file_name, "r");
		
		$rank_word = array();
		while( ($line = fgets($file_handle)) !== false ){
			
			$tmp = explode("\t", $line);
			if(count($tmp) == 2){
				$rank_word[] = $tmp;
			}else{					
				die('count was'.count($tmp).' Error occured!');
			}
		}
		
		fclose($file_handle);
		
		$col_num = 5;
		$row_num = intval(100/$col_num);
		echo "<table>";
			for($i=0; $i<$row_num; $i++){
				echo "<tr>";
				for($j = 0; $j<$col_num; $j++){
					echo "<td>[No. " . (($i*$col_num)+$j+1) . ": </td><td> ". $rank_word[($i*$col_num)+$j][0] . " ]</td>";
				}
				echo "</tr>";
			}		
		echo "</table>";
	?>

	<br>
	[<a href="./dictionary.php">상위 메뉴로</a>]<br>
	[<a href="/index.php">main으로</a>]<br>
		
</body>
</html>