<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/mystyle.css">
<script language="javascript" src="check_form.js"></script>
<script language="javascript" src="sha512.js"></script>
</head>
<body>
<div class="content">
<h1>회원 가입</h1>
<form action="register.php" method="post">
	<table>
		<tr><td>USERNAME:</td><td><input type="text" id="username" name="username"></td></tr>
		<tr><td>PASSWORD:</td><td><input type="password" id="password" name="password"></td></tr>
		<tr><td>PASSWORD2: </td><td><input type="password" id="password2" name="password2"></td></tr>
		<tr><td>NICKNAME:</td><td><input type="text" id="nickname" name="nickname"></td></tr>
		<tr><td>EMAIL:</td><td><input type="text" id="email" name="email"></td></tr>
	</table>
<!--	<input type="submit" value="Submit"> -->
	<input type="button" onclick="checkRegisterForm(this.form, this.form.username, this.form.password, this.form.password2);" value="가입하기">
</form>
</div>
</body>
</html>