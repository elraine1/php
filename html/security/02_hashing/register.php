<?php

require_once 'session.php';
 
if (isset($_POST['id'], $_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password']; 
	
	$handle = fopen(USER_ACCOUNTS_FILE_NAME, "a");
	fwrite($handle, $_POST["id"]);
	fwrite($handle, "\t");
	fwrite($handle, password_hash($_POST["password"], PASSWORD_DEFAULT));
	fwrite($handle, "\r\n");
	fclose($handle);
	header('Location: index.php');
} else {
    echo '회원가입 폼 에러';
}
