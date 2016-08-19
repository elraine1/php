
<style type="text/css">
	#login_bar{
		width: 100%;
		height: 22px;
		margin: 0 auto;
		padding: 5px 5px 10px 5px;
		background-color: SandyBrown;
	}
	
	#span_welcome{
		display: inline-block;
	}
</style>


<div id="login_bar">
	<script language="javascript" src="/board/03_login/user/check_form.js"></script>
	<script language="javascript" src="/board/03_login/user/sha512.js"></script>
<?php 
	require_once('session.php');	
	start_session();	// 해당 페이지에서 세션이 켜져있는지 확인 가능?? 
//	echo $_SERVER["REQUEST_URI"];

	$_SESSION['request_uri'] = $_SERVER["REQUEST_URI"];
	//echo $_SESSION['request_uri'];
	
	if(isset($_SESSION['login_status']) && ($_SESSION['login_status'] == true)){ 
		printf("<div id='logon'>");
		printf("<span id='span_welcome'> <b>%s</b> 님 반갑습니다.</span> ", $_SESSION['nickname']);
		printf("<a href='/board/03_login/user/view_profile.php?username=%s'><button>내정보보기</button></a>", $_SESSION['username']);
		printf("<a href='/board/03_login/user/logout.php'><button>로그아웃</button></a>");
		printf("</div>");
		
	}else {
		
		printf("<div id='not_login'>");
		printf("<form action='/board/03_login/user/login.php' method='post'>");
		printf("USERNAME: <input type='text' id='username' name='username'/> ");
		printf("PASSWORD: <input type='password' id='password' name='password'/> ");
		printf("<input type='button' onclick='checkLoginForm(this.form, this.form.username, this.form.password);' value='확인'/>");
		printf("<a href='/board/03_login/user/register_page.php'> Sign Up </a>");
		printf("</form>");
		printf("</div>");

	}	
?>

</div>