<?php

$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
require_once($mylib_path);
require_once('session.php');	
				
if (isset($_POST['username'], $_POST['hash'])) {
    $username = $_POST['username'];
    $hash = $_POST['hash'];
	$nickname = $_POST['nickname'];
	$email = $_POST['email'];
	
	$conn = get_sqlserver_conn();
	$stmt = mysqli_prepare($conn, "SELECT hash FROM user_account WHERE username = ?"); 	
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if (mysqli_num_rows($result) != 0) { // 이미 등록된 아이디	// 닉네임, 이메일 중복처리 필요.
		header('Location: error.php?error_code=4');
	} else {
		$stmt = mysqli_prepare($conn, "INSERT INTO user_account(username, hash, nickname, email) VALUES (?, ?, ?, ?)");	
		mysqli_stmt_bind_param($stmt, "ssss", $username, password_hash($hash, PASSWORD_DEFAULT), $nickname, $email);
		mysqli_stmt_execute($stmt);
		
		header('Location: ../index.php');
	}
	mysqli_free_result($result);
	mysqli_close($conn);
} else {
    echo '회원가입 폼 에러';
}
