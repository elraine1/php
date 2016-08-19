<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Basic 76</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->


	<style type="text/css">
		
		table{
			border:1px solid red;
		}
	
	</style>

	<script>
	
	
	
	
	</script>

</head>
<body>


	<div height="400px">
	
	<?php
		
		echo "<h2> - Mancala! - </h2>";
		
		$player1_cups = array(4,4,4,4,4,4);
		$player1_mancala = 0;
		$player2_cups = array(4,4,4,4,4,4);
		$player2_mancala = 0;
		
		echo "player1 ";
		print_r($player1_mancala);
		echo " : ";
		print_r($player2_mancala);
		echo " player2 ";

	?>
	<table id="mancala_board">
	<tr>
		<?php
		
			printf("<td rowspan='2'><input type='button' value='%d' disabled></td>", $player2_mancala);
			for($i = 5; $i >= 0 ; $i--){
				printf("<td><input type='button' value='%d' ></td>", $player2_cups[$i]);
			}
			printf("<td rowspan='2'><input type='button' value='%d' disabled></td>", $player1_mancala);
		?>
	</tr>
	<tr>
		<?php
			for($i = 0; $i <= 5 ; $i++){
				printf("<td><input type='button' value='%d'></td>", $player1_cups[$i]);
			}
		?>
	</tr>
	
	</table>
	
	
	
	
	</div>


</body>
</html>
