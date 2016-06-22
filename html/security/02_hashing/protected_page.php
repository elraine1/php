<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/mystyle.css">
</head>
<body>
<div class="content">
<?php
	require_once 'session.php';
	start_session();
	if (check_login()) {
		echo "<h1>로그인 성공!</h1>";
?>
		<form action="index.php">
			<input type="submit" value="메인메뉴로 돌아가기">
		</form>
<?php
	} else {
		header("Location: error.php?error_code=3");
	}
?>
</div>
</body>
</html>