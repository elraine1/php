
<h2> - Mancala! - </h2>
<?php
	require_once ('./user/session.php');
	start_session();

	if($_SERVER['REQUEST_METHOD'] == "GET"){
		
		$turn = $_GET['turn'];
		$cup_index = $_GET['cup'];
		
	}

	$cups = $_SESSION['cups'];
	
	
	if($turn == 'p1'){
		$curr_player = 0;
	}else if($turn == 'p2'){
		$curr_player = 1;
	}
	
	$left_stones = $cups[$curr_player][$cup_index];
	$cups[$curr_player][$cup_index] = 0;
		
//	$cup_idx = $cup_index;
	while($left_stones > 0){			
		if($cup_index < count($cups[$curr_player])-1){
			$cup_index++;
		}else {
			$curr_player = ($curr_player+1)%2;
			$cup_index = 0;
		}
		$cups[$curr_player][$cup_index] += 1;
		$left_stones--;
	
	}
	
	
	
	//// 턴 구현할 것. 08.19
	if($_SESSION['turn'] == 'p1'){
		$_SESSION['turn'] = 'p2';
	}else{
		$_SESSION['turn'] = 'p1';
	}
	
	
	$_SESSION['cups'] = $cups;
		
	
	// href test.php
	
?>


	<table id="mancala_board">
	<tr>
		<?php
		
			printf("<td rowspan='2'><input type='button' value='%d' disabled></td>", $cups[1][6]);
			for($i = 5; $i >= 0 ; $i--){
				printf("<td><a href='process.php?turn=p2&cup=%d'><input type='button' value='%d' " . ($turn == 'p1'? 'disabled' : '') . "></a></td>", $i, $cups[1][$i]);
			}
			printf("<td rowspan='2'><input type='button' value='%d' disabled></td>", $cups[0][6]);
		?>
	</tr>
	<tr>
		<?php
			for($i = 0; $i <= 5 ; $i++){
				printf("<td><a href='process.php?turn=p1&cup=%d'><input type='button' value='%d' " . ($turn == 'p2'? 'disabled' : '') . "></a></td>",$i, $cups[0][$i]);
			}
		?>
	</tr>
	</table>
	
	