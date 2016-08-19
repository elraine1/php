function checkRegisterForm(form, id, password, password2) {
	
    if (id.value == '' || 
          password.value == '' ) {
        alert('아이디와 비밀번호는 빈칸 안됨');
        return false;
    }

	// 최소한 4자리
    if (id.value.length < 4) {
        alert('아이디는 4자리 이상이여야함');
        id.focus();
        return false;
    }
    // id 검사
    var re = /^\w+$/; 
    if(!re.test(id.value)) { 
        alert('아이디는 숫자와 영문자, _ 만 가능함'); 
        id.focus();
        return false; 
    }

	// 최소한 6자리
    if (password.value.length < 6) {
        alert('암호는 6자리 이상이여야함');
        password.focus();
        return false;
    }
    // 최소한 1개씩의 숫자, 영소문자, 영대문자
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('암호는 숫자, 영소문자, 영대문자를 1개씩 포함해야 함');
		password.focus();
        return false;
    }
 
	// 암호 확인
    if (password.value != password2.value) {
        alert('암호 확인이 맞지 않음');
        password.focus();
        return false;
    }
 
    // 해쉬 값을 포함할 요소 생성
    var hash = document.createElement("input");
    form.appendChild(hash);
    hash.name = "hash";
	hash.type = "hidden";
    hash.value = hex_sha512(password.value);
 
    password.value = '';
    password2.value = '';

    form.submit();
    return true;
}

function checkLoginForm(form, id, password) { 
	
    if (id.value == '' || 
          password.value == '' ) {
        alert('아이디와 비밀번호는 빈칸 안됨');
        return false;
    }
	 
    // 해쉬 값을 포함할 요소 생성
    var hash = document.createElement("input");
    form.appendChild(hash);
    hash.name = "hash";
	hash.type = "hidden";
    hash.value = hex_sha512(password.value);
 
    password.value = '';

    form.submit();
    return true;
}