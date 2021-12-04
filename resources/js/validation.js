function pwd_validation(pwd){
    let amount_Nan=0;
    const pwd_len = pwd.length;
    for(var i=0; i<pwd_len; i++){
        if(isNaN(pwd[i])){
            amount_Nan++;
        }
    }
    num_amount=pwd_len-amount_Nan;
    if(pwd_len>num_amount){
        return true;
    }
    alert('Password can not be without letters');
    // pwd.focus();
    return false;
}

function password_repeat_validation(pwd, pwd_repeat) {
    if(pwd==pwd_repeat){
        return true;
    }
    alert('Passwords are not equal!');
    // pwd_repeat.focus();
    return false;
}

function form_validation(){
    if($('.registration').hasClass('open')){
        var login = document.registration.login.value;
        var pwd = document.registration.password.value;
        var pwd_repeat=document.registration.password_repeat.value;
        var email = document.registration.email.value;
        var phone = document.registration.phone.value;
        if(pwd_validation(pwd)){
            if(password_repeat_validation(pwd, pwd_repeat)){
                console.log(login+' '+pwd+' '+email+' '+phone);
            }
        }
    }
    if($('.enter').hasClass('open')){
        var login = document.enter.login.value;
        var pwd = document.enter.password.value;
        if(pwd_validation(pwd)){
            console.log(login+' '+pwd);
        }
    }
    return false;
}