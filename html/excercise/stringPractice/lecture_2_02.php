<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/mystyle.css">
</head>
<body>
<div class="content">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$comment = $_POST['comment'];
	$gender = $_POST['gender'];
}

echo '<h1>폼으로 전달받은 값들 아래와 같습니다</h1>';
echo '이름: '.$name;
echo '<br>';
echo '이메일: '.$email;
echo '<br>';
echo '웹사이트: '.$website;
echo '<br>';
echo '코멘트: '.$comment;
echo '<br>';
echo '성별: '.$gender;

?>
</div>
</body>
</html>