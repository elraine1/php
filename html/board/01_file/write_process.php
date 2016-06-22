<?php 	
	require_once('board_functions.php');
	
	$file_name = './board.txt';
	$lines = get_lines($file_name);	
	
	$line = make_string_from_writeform($lines);
	write_to_file($file_name, $line);

	link_goto_main(); 
?>
