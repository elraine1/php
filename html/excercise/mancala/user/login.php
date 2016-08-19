<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php

$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
require_once($mylib_path);
require_once ('session.php');
start_session();
 
if (isset($_POST['username'], $_POST['hash'])) {
    $username = $_POST['username'];
    $hash = $_POST['hash']; 
	
//	echo $username . " & " . $hash;
    if (try_to_login($username, $hash) == true) {
		header('Location: protected_page.php');
    } else {
		// 이멜주소 또는 비번이 등록되지 않았거나 틀림
		header('Location: error.php?error_code=1');
    }
} else {
    echo '로그인 폼 에러';
}
?>
</body>
</html>