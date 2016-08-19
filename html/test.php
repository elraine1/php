

<?php
	print "<h4>Int to ..</h4>";
	
		var_dump(intval(0)) . '<br>';
	var_dump(intval(1)) . '<br><br>';
	
	var_dump(floatval(0)) . '<br>';
	var_dump(floatval(1)) . '<br><br>';
	
	var_dump(strval(0)) . '<br>';
	var_dump(strval(1)) . '<br><br>';
	
	var_dump(boolval(0)) . '<br>';
	var_dump(boolval(1)) . '<br><br>';
	

	print "<h4>Float to ..</h4>";
	
	var_dump(intval(0.0)) . '<br>';
	var_dump(intval(1.9)) . '<br><br>';
	
	var_dump(floatval(0.0)) . '<br>';
	var_dump(floatval(1.9)) . '<br><br>';
	
	var_dump(strval(0.0)) . '<br>';
	var_dump(strval(1.9)) . '<br><br>';
	
	var_dump(boolval(0.0)) . '<br>';
	var_dump(boolval(1.9)) . '<br><br>';
	
	
	print "<h4>Str to ..</h4>";
	
	var_dump(intval('')) . '<br>';
	var_dump(intval('0')) . '<br><br>';
	var_dump(intval(0.0)) . '<br>';
	var_dump(intval(1.9)) . '<br><br>';
	
	var_dump(floatval('')) . '<br>';
	var_dump(floatval('0')) . '<br><br>';
	var_dump(floatval(0)) . '<br>';
	var_dump(floatval(1)) . '<br><br>';
	
	var_dump(strval('')) . '<br>';
	var_dump(strval('0')) . '<br><br>';
	var_dump(strval(0)) . '<br>';
	var_dump(strval(1)) . '<br><br>';
	
	var_dump(boolval('')) . '<br>';
	var_dump(boolval('0')) . '<br><br>';
	var_dump(boolval(0)) . '<br>';
	var_dump(boolval(1)) . '<br><br>';
	


	print "<h4>boolean to ..</h4>";
	
	var_dump(intval(true)) . '<br>';
	var_dump(intval(false)) . '<br><br>';
	
	var_dump(floatval(true)) . '<br>';
	var_dump(floatval(false)) . '<br><br>';
	
	var_dump(strval(true)) . '<br>';
	var_dump(strval(false)) . '<br><br>';
	
	var_dump(boolval(true)) . '<br>';
	var_dump(boolval(false)) . '<br><br>';
	
	
	print "<h4>array to ..</h4>";
	
	var_dump(intval(array())) . '<br>';
	var_dump(intval(array('a'))) . '<br><br>';
	
	var_dump(floatval(array())) . '<br>';
	var_dump(floatval(array('a'))) . '<br><br>';
	
	var_dump(strval(array())) . '<br>';
	var_dump(strval(array('a'))) . '<br><br>';
	
	var_dump(boolval(array())) . '<br>';
	var_dump(boolval(array('a'))) . '<br><br>';
	
	
	print "<h4>etc</h4>";
	var_dump(boolval('false'));
	var_dump(strval(true));
	var_dump(strval(false));
	
	var_dump(intval(''));
	var_dump(floatval(''));
	var_dump(boolval(''));
	
	echo '<br>';
	var_dump(floatval(true));
	var_dump(strval(true));
	var_dump(floatval(false));
	var_dump(strval(false));

	
	var_dump(intval(null));
	var_dump(floatval(null));
	var_dump(strval(null));
	var_dump(boolval(null));
	

	// call_user_func
	

?>