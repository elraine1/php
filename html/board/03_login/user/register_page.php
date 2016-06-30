<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/mystyle.css">
</head>
<body>
<div class="content">
<h1>가입할 회원 정보를 입력하시오</h1>
<form action="register.php" method="post">
	<table>
		<tr><td>USERNAME:</td><td><input type="text" name="username"></td></tr>
		<tr><td>PASSWORD:</td><td><input type="password" name="password"></td></tr>
		<!-- <tr><td>confirm:</td><td><input type="password" name="password"></td></tr>             비밀번호 재입력 --> 
		<tr><td>NICKNAME:</td><td><input type="text" name="nickname"></td></tr>
		<tr><td>EMAIL:</td><td><input type="text" name="email"></td></tr>
	</table>
	
	<input type="submit" value="Submit">
</form>
</div>
</body>
</html>