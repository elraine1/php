<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>

	<?php 
		// request로부터 수식 입력. 
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$formula = $_GET['formula'];
		}
	?>
	
	<?php 	
		// 수식(str)에서 공백 제거
		function remove_space_in_formula($formula){
			
			$formula2 = "";
			$token = strtok($formula, " ");
			
			$formula2 .= $token;
			while($token !== false){
				$token = strtok(" ");
				$formula2 .= $token;
			}
			return $formula2;
		}
	
		// 수식(str)에서 연산자만 추출
		function get_operators($formula){
			
			$operators = array();
			$token = strtok($formula, "1234567890");

			while($token !== false){
				$operators[] = $token;
				$token = strtok("1234567890");
			}
	
			return $operators;
		}
		
		// 수식(str)에서 숫자만 추출
		function get_numbers($formula){
			
			$numbers = array();
			
			$token = strtok($formula, "+-*/");
			while($token !== false){
				$numbers[] = $token;
				$token = strtok("+-*/");
			}
			
			return $numbers;
		}
		
		// 수식을 배열형태로 반환.
		function get_formula_arr($formula){
			
			$numbers = get_numbers($formula);
			$operators = get_operators($formula);
			
			$formula_arr = array();
			for($i=0; $i < count($operators); $i++){
				$formula_arr[] = $numbers[$i];
				$formula_arr[] = $operators[$i];
			}
			$formula_arr[] = $numbers[$i];
			
			return $formula_arr;
		}
		
		
		// infix to postfix   다시 볼 것. 0610.
		function infix_to_postfix($formula_arr){
			
			$result = array();			
			$operators = array();
			
			for($i=0; $i < count($formula_arr); $i++){
				
				switch($formula_arr[$i]){
					case '+':
					case '-': 
						if(end($operators) == '+' || end($operators) == '-' || count($operators) == 0){
							array_push($operators, $formula_arr[$i]); 
						}else {
							while( count($operators) > 0 ){
								$result[] = array_pop($operators);
							}
							array_push($operators, $formula_arr[$i]);
						}
						break; 
						
					case '*':
					case '/': array_push($operators, $formula_arr[$i]); break;
					
					default : $result[] = $formula_arr[$i]; break; 
				}
				echo "char: $formula_arr[$i] //  operator : " . join(" ", $operators) . " // postfix: " . join(" ", $result) . "<br>"; 
			}
			
			
			if( $i == count($formula_arr) ){
				while( count($operators) > 0 ){
					$result[] = array_pop($operators);
				}
			}
			
			return $result;
		}
		
		// postfix 계산.
		function calculation($postfix_formula){
			
			$stack = array();
			$num1 = 0;
			$num2 = 0;
			for($i=0; $i < count($postfix_formula); $i++){
				
				if(is_numeric($postfix_formula[$i])){
					array_push($stack, $postfix_formula[$i]);
				}else {
					$num2 = array_pop($stack);
					$num1 = array_pop($stack);
					
					switch($postfix_formula[$i]){
						case '+': array_push($stack, $num1+$num2); break;
						case '-': array_push($stack, $num1-$num2); break;
						case '*': array_push($stack, $num1*$num2); break;
						case '/': array_push($stack, $num1/$num2); break;
						default : break;
						
					}
				}	
			}		
			$result = array_pop($stack);
			return $result;
		}
		
		
		$formula = remove_space_in_formula($formula);
		$formula_arr = get_formula_arr($formula);	
		echo "infix = " . join(" ", $formula_arr) . "<br>";

		$formula_arr = infix_to_postfix($formula_arr);
		echo "postfix = " . join(" ", $formula_arr) . "<br>";
			
		$result = calculation($formula_arr);
		

	?>
	
	<h2>계산 결과</h2>

	입력된 수식 <?php echo $formula?> 의 계산 결과는 
	<?php echo $result;?>입니다. <br>
		
</body>
</html>