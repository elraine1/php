<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php
require_once 'session.php';
 
start_session();
 
if (isset($_POST['id'], $_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password']; 
	echo "login.php";
	
    if (try_to_login($id, $password) == true) {
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