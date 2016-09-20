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
	
</style>



<h2> - Mancala! - </h2>
	

<?php
	require_once ('./user/session.php');
	start_session();

	$p1_cups = array(4,4,4,4,4,4,0);
	$p2_cups = array(4,4,4,4,4,4,0);
	
	$cups = array($p1_cups, $p2_cups);
	$_SESSION['cups'] = $cups;
		

?>

	<h3>Offline Mode</h3>

	<table id="mancala_board">
	<tr>
		<?php
			printf("<td rowspan='2'><input type='button' value='%d' class='mancala p2' disabled></td>", $cups[1][6]);
			for($i = 5; $i >= 0 ; $i--){
				printf("<td><a href='process.php?turn=p2&cup_index=%d'><input type='button' class='cups p2' value='%d'></a></td>", $i, $cups[1][$i]);
			}
			printf("<td rowspan='2'><input type='button' value='%d' class='mancala p1' disabled></td>", $cups[0][6]);
		?>
	</tr>
	<tr>
		<?php
			for($i = 0; $i <= 5 ; $i++){
				printf("<td><a href='process.php?turn=p1&cup_index=%d'><input type='button' class='cups p1' value='%d'></a></td>",$i, $cups[0][$i]);
			}
		?>
	</tr>
	</table>
	
	</body>
</html>
	