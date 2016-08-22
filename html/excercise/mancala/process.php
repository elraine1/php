<style type="text/css">
	#mancala_board {
		border: 2px solid gray;
		
	}
	
	.mancala{
		width: 50px;
		height: 100px;
		border-radius: 10px;
		font-weight: bold;
		font-size: 15px;
	}
	
	.cups{
		width: 50px;
		height: 50px;
		border-radius: 10px;
		
		font-weight: bold;
		font-size: 15px;
	}
	
	.p2{
		color: MidnightBlue ;
	}
	.p1{
		color: green;
	}
	
	input[type="button"]:disabled {
		background: darkgray;
	}
</style>



<h2> - Mancala! - </h2>
<?php
	require_once ('mancala_lib.php');
	require_once ('./user/session.php');
	start_session();

	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$turn = $_GET['turn'];
		$cup_index = $_GET['cup_index'];
	}

	$cups = $_SESSION['cups'];
	
	if($turn == 'p1'){
		$curr_player = 0;
		$player_index = 0;
	}else if($turn == 'p2'){
		$curr_player = 1;
		$player_index = 1;
	}
	
	$stone = $cups[$player_index][$cup_index];
	$cups[$player_index][$cup_index] = 0;
		
	while($stone > 0){		
		
		$cup_index += 1;
		if($cup_index == 6){			//
			
			if($player_index === $curr_player){
				$stone--;
				$cups[$player_index][$cup_index] += 1;
			}
				
			$player_index = ($player_index + 1) % 2;
			$cup_index = -1;
			
		} else{
	
			$stone--;
			$cups[$player_index][$cup_index] += 1;

		}
	}
	
	if(!(($cup_index === -1) && ((($player_index+1)%2) === $curr_player))){

	// 내 빈 컵에서 턴이 끝났다면(통에 내가 넣은 돌만 있는 경우),  맞은편에 있는 상대방의 컵에 있는 돌을 내 만칼라 통으로 가져간다.
		$op_index = ($player_index+1)%2;			// opponents player 
		$op_cup_index = count($cups[0]) - $cup_index - 2;
		if($player_index === $curr_player && $cups[$player_index][$cup_index] == 1 && $cups[$op_index][$op_cup_index] > 0){
			$cups[$curr_player][6] += $cups[$player_index][$cup_index];
			$cups[$curr_player][6] += $cups[$op_index][$op_cup_index];
			
			$cups[$player_index][$cup_index] = 0;
			$cups[$op_index][$op_cup_index] = 0;			
		}
	
		$turn = turn_over($turn);
	}
	
	
	if(is_gameset($cups)){
		$b_gameset = true;
		
		$cups[0][6] = array_sum(array_slice($cups[0], 0, 6));
		$cups[1][6] = array_sum(array_slice($cups[1], 0, 6));
		
		for($i=0; $i<6; $i++){
			$cups[0][$i] = 0;
			$cups[1][$i] = 0;
		}
	
		echo "<h2>경기 종료!</h2>";
	}
	
	$_SESSION['cups'] = $cups;	

//	var_dump(is_empty_cup($cups, $player_index, $cup_index));
	// href test.php
	
?>

	<h3><?php echo "$turn's Turn!"; ?></h3>
	<table id="mancala_board">
	<tr>
		<?php
		
			printf("<td rowspan='2'><input type='button' value='%d' class='mancala p2' disabled></td>", $cups[1][6]);
			for($i = 5; $i >= 0 ; $i--){
				if($cups[1][$i] == 0){
					printf("<td><input type='button' class='cups p2' value='%d' " . ($turn == 'p1'? 'disabled' : '') . "></td>", $cups[1][$i]);
				}else {
					printf("<td><a href='process.php?turn=p2&cup_index=%d'><input type='button' class='cups p2' value='%d' " . ($turn == 'p1'? 'disabled' : '') . "></a></td>", $i, $cups[1][$i]);
				}
				
			}
			printf("<td rowspan='2'><input type='button' value='%d' class='mancala p1' disabled></td>", $cups[0][6]);
		?>
	</tr>
	<tr>
		<?php
			for($i = 0; $i <= 5 ; $i++){
				
				if($cups[0][$i] == 0){
					printf("<td><input type='button' class='cups p1' value='%d' " . ($turn == 'p2'? 'disabled' : '') . "></td>", $cups[0][$i]);
				}else {
					printf("<td><a href='process.php?turn=p1&cup_index=%d'><input type='button' class='cups p1' value='%d' " . ($turn == 'p2'? 'disabled' : '') . "></a></td>", $i, $cups[0][$i]);
				}
			}
		?>
	</tr>
	</table>
	
	
	
	
	
	
	<br><br>
	<a href="test.php"><button>go test.php</button></a>
	
	
	
	
	