<?php

require_once 'session.php';
 
start_session();
 
if (isset($_POST['id'], $_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password']; 
 
    if (try_to_login($id, $password) == true) {
        header('Location: protected_page.php');			// redirect
    } else {
		// 이멜주소 또는 비번이 등록되지 않았거나 틀림
        header('Location: error.php?error_code=1');
    }
} else {
    echo '로그인 폼 에러';
}
