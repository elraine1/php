<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/mystyle.css">
</head>
<body>
<div class="content">
<?php
	require_once ('session.php');
	start_session();
	if (check_login()) {
//		echo $_SESSION['login_status'] . " / " . $_SESSION['username'] . " / " . $_SESSION['password'];
//		echo "<h1>로그인 성공!</h1>";
		header("Location: ../index.php");

	} else {
		header("Location: error.php?error_code=3");
	}
?>
</div>
</body>
</html>