<?php
$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_board.php';
require_once($mylib_path);

class UserInfo{
	
	public $user_id; 
	public $username;
	public $nickname;
	public $email;
	public $join_date;
	
	// 생성자
	public function __construct($user_id, $username, $nickname, $email, $join_date) {
		$this->user_id = $user_id;
		$this->username = $username;
		$this->nickname = $nickname;
		$this->email = $email;
		$this->join_date = $join_date;
	}
	
}

// 하나의 페이지에서 한 번만 호출되어야 한다.
function start_session() {
    $secure = false; // https
    $httponly = true; // 클라이언트에서 세션 쿠키를 수정 불가능 
	
    // 세션이 쿠키만 사용하도록 강제
    if (ini_set('session.use_only_cookies', 1) === false) {
        header("Location: error.php?error_code=2");
        exit();
    }
	
    $params = session_get_cookie_params();
    session_set_cookie_params($params["lifetime"],
        $params["path"], 
        $params["domain"], 
        $secure,
        $httponly);
 
    session_start();
    session_regenerate_id(true); // session fixation 대비
}

 // start_session 호출된 후에 사용되어야 한다
function destroy_session() {
	$_SESSION = array(); // 모든 세션 변수 제거
	// 세션 쿠키 제거
	$params = session_get_cookie_params(); // 쿠키삭제를 위해서는 생성될때의 인자들을 알아야한다.
	setcookie(session_name(), '', 0, 
		$params['path'], $params['domain'], $params['secure'], isset($params['httponly'])); 
	session_destroy(); 
}

 // start_session 호출된 후에 사용되어야 한다
function try_to_login($username, $password) {
	
	if (check_user_account($username, $password)) {
		
		$userinfo = get_user_info($username, $password);
		
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['user_id'] = $userinfo->user_id;	
		$_SESSION['username'] = $userinfo->username;
		$_SESSION['nickname'] = $userinfo->nickname;
		$_SESSION['email'] = $userinfo->email;
		$_SESSION['join_date'] = $userinfo->join_date;
		$_SESSION['login_status'] = true;
		
		return true;
		
	} else {
		return false;
	}
}

// 사용자 정보를 세션에 등록하는 함수.
function get_user_info($username, $password){
	
	$conn = get_sqlserver_conn();
	$stmt = mysqli_prepare($conn, "SELECT * FROM user_account WHERE username = ?");
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result);
	
	$userinfo = new UserInfo($row['user_id'], $username, $row['nickname'], $row['email'], $row['join_date']);

	mysqli_free_result($result);
	mysqli_close($conn);	

	return $userinfo;
}



function check_user_account($username, $password) {
	
	$conn = get_sqlserver_conn();
	$stmt = mysqli_prepare($conn, "SELECT hash FROM user_account WHERE username = ?");
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if (mysqli_num_rows($result) === 0) { // 등록되지 않은 아이디
		header('Location: error.php?error_code=1');
	} else {
		$row = mysqli_fetch_assoc($result);
		$hash = $row["hash"];

		return password_verify($password, $hash);
	}
	mysqli_free_result($result);
	mysqli_close($conn);	
}

// start_session 호출된 후에 사용되어야 한다
function check_login() {
	
	return isset($_SESSION['ip'], $_SESSION['user_agent'], $_SESSION['login_status']) && 
		// 세션 탈취를 방어. 세션이 생성될 때의 ip, 브라우저와 현재 상태가 동일한 지 확인.
		$_SESSION['ip'] == $_SERVER['REMOTE_ADDR'] && 
		$_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'] &&
		$_SESSION['login_status'];
}


// start_session 호출된 후에 사용되어야 한다
function try_to_logout() {
	if (check_login()) {
		$_SESSION['login_status'] = false;
	} else {
	}
}

 ?>