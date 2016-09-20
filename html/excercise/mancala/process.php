<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
	
	
	@keyframes example {
		from {color: red;}
		to {color: black;}
	}

	.mytimer {
		animation-name: example; 
		animation-duration: 1.5s; 	
	}

	.timer {
		display: block; 
		width: 800px; 
		margin:0 auto; 
		margin-top: 100px; 
		font-size:100px	;
		text-align: center;
	}

	.temp{
		font-size:150px;
	}

</style>


<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery-ui.js"></script>
<script type="text/javascript" src="./jquery/jquery.countdown.js"></script>
<script>

	$(document).ready(function(){
		/*
		window.onbeforeunload = function() {
			return "게임을 마치지 않고 나가면 징계를 먹습니다.";
		};
		
		window.onunload = function() {
			// 만약 게임중이면 징계먹이기
			return;
		};
		
		// disable F5 key
		function disableF5(e) { 
			if ((e.which || e.keyCode) == 116) {
				e.preventDefault(); 
			}
		}
		$(document).on("keydown", disableF5);
		*/
		function flick() {			
			/*
			var els = document.getElementsByClassName('mytimer');
			var flash = els[0];		
			var newNode = flash.cloneNode(true);
			newNode.id = flash.id + '1';
			flash.parentNode.replaceChild(newNode, flash);
			newNode.className = 'timer mytimer';
			*/
			$('#flash').addClass('temp', 900, callBack());
			/*
			$('#flash').animate({font-size:200px;
									 color:red;    }, 1000);
									 */
			//flash.style.color = 'red';
			//setTimeout(function() { flash.style.color = 'black'; }, 100);	
		}
		
		function callBack(element){
			$('#flash').removeClass('temp');
		}
		

		$('#timer').countdown(Date.now() + 10000, function(event) { 
			var remainingSecondsString =  event.strftime('%-S');
			$(this).text(remainingSecondsString); 
			if (parseInt(remainingSecondsString) == 0) {
				$(this).text('Time Over');
			} else if (parseInt(remainingSecondsString) % 2 == 0) {
				$(this).css('color', 'red');
			} else {
				$(this).css('color', 'blue');
			}
		});
		
		$('#dummy').countdown(Date.now() + 10000, function(event) { 
			flick();
		});
	});
</script>

</head>
<body>

<!--
<span id="timer" class="timer">Timer not started yet</span>
<span id="flash" class="timer mytimer">Flash</span>
<span id="dummy"></span>
-->
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

</body>
</html>
	
	
	