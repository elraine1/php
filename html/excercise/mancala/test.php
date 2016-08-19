<h2> - Mancala! - </h2>
	

<?php
	require_once ('./user/session.php');
	start_session();

	$p1_cups = array(4,4,4,4,4,4,0);
	$p2_cups = array(4,4,4,4,4,4,0);
		
	$_SESSION['cups'] = array($p1_cups, $p2_cups);
		

?>

	<table id="mancala_board">
	<tr>
		<?php
		
			printf("<td rowspan='2'><input type='button' value='%d' disabled></td>", $p2_cups[6]);
			for($i = 5; $i >= 0 ; $i--){
				printf("<td><a href='process.php?turn=p2&cup=%d'><input type='button' value='%d' ></a></td>", $i, $p2_cups[$i]);
			}
			printf("<td rowspan='2'><input type='button' value='%d' disabled></td>", $p1_cups[6]);
		?>
	</tr>
	<tr>
		<?php
			for($i = 0; $i <= 5 ; $i++){
				printf("<td><a href='process.php?turn=p1&cup=%d'><input type='button' value='%d'></a></td>",$i, $p1_cups[$i]);
			}
		?>
	</tr>
	</table>