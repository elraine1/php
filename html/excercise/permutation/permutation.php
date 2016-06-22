<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
	<h2>순열 찾기</h2>

	<?php 
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$input_num = $_GET['number'];
		}
		
		function make_arr($num){
			$arr = array();
			for($i=0; $i<$num; $i++){
				$arr[] = $i+1;
			}
			return $arr;
		}
	
		function print_recursive_permutation($num_arr){
		
			if(count($num_arr) == 1){
				echo $num_arr[0] . "<br>";
//				return $num_arr[0];
			}else{	
				for($i=0; $i < count($num_arr); $i++){
					
					$arr = array();
					for($j=0; $j< count($num_arr); $j++){
						if($j != $i){
							$arr[] = $num_arr[$j];
						}
					}
					
//					echo $num_arr[$i] . " [" . join("][", $arr) . "]<br>";		
					echo $num_arr[$i];
					print_recursive_permutation($arr);
//					echo "<br>";
				}
			}
		}
		
		$num_arr = make_arr($input_num);
		echo "original_arr : " . join(", ", $num_arr) . "<br><br>";
		print_recursive_permutation($num_arr);
		
		
		
	?>
	<br><br>
	[<a href="/index.php">main으로</a>]
		
</body>
</html>