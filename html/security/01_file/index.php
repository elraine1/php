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
?>
	<h1>현재 로그인 되어 있는 상태입니다</h1>
	<form action="logout.php" method="get">
		<input type="submit" value="로그아웃">
	</form>	
<?php
	} else {
?>
	<h1>로그인 하십시오</h1>
	<form action="login.php" method="post">
	<table>
		<tr><td>E-mail:</td><td><input type="text" name="id"></td></tr>
		<tr><td>비번:</td><td><input type="text" name="password"></td></tr>
		<tr><td></td><td><input type="submit" value="로그인"></td>
	</table>
	</form>
<?php
	}
?>
</div>
</body>
</html>