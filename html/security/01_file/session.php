<?php

// 하나의 페이지에서 한 번만 호출되어야 한다.
function start_session() {
    $secure = false; // https 사용 여부 결정 변수.
    $httponly = true; // 클라이언트에서 세션 쿠키를 수정 불가능 
	
    // 세션이 쿠키만 사용하도록 강제
    if (ini_set('session.use_only_cookies', 1) === false) {
        header("Location: error.php?errer_code=2");
        exit();
    }
	
    $params = session_get_cookie_params();
    session_set_cookie_params($params["lifetime"],
        $params["path"], 
        $params["domain"], 
        $secure,
        $httponly);
 
    session_start();
    session_regenerate_id(true); // session fixation 대비, session id를 재생성 함으로써 보안을 강화.
}

 // start_session 호출된 후에 사용되어야 한다
function destroy_session() {
	$_SESSION = array(); // 모든 세션 변수 제거
	// 세션 쿠키 제거
	$params = session_get_cookie_params();  // 쿠키삭제를 위해서는 생성될때의 인자들을 알아야한다.
	setcookie(session_name(), '', 0, 		// time에 해당하는 인자를 0으로 줌으로써 쿠키의 유효기간을 만료시킴.
		$params['path'], $params['domain'], $params['secure'], isset($params['httponly'])); 
	session_destroy(); 						// 세션 연결 종료.
}

 // start_session 호출된 후에 사용되어야 한다
function try_to_login($id, $password) {
	if ($id === "student" && $password === "student") {
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['login_status'] = true;
		return true;
	} else {
		return false;
	}
}

// start_session 호출된 후에 사용되어야 한다
function check_login() {
	return isset($_SESSION['login_status'], $_SESSION['ip'], $_SESSION['user_agent']) && 
		// 세션 탈취를 방어. 세션이 생성될 때의 ip, 브라우저와 현재 상태가 동일한 지 확인.
		$_SESSION['ip'] == $_SERVER['REMOTE_ADDR'] && 
		$_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'] &&
		$_SESSION['login_status'] == true;
}

// start_session 호출된 후에 사용되어야 한다
function try_to_logout() {
	if (check_login()) {
		$_SESSION['login_status'] = false;
	} else {
	}
}
