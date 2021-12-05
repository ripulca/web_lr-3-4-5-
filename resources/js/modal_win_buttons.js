$('.sign_in').click(function () {
    if(!$('.enter').hasClass('open')){ 
        $('.enter').addClass(' open');
    }        
    if($('.registration').hasClass('open')){ 
        $('.registration').removeClass(' open');
    }
})

$('.sign_up').click(function () {
    if(!$('.registration').hasClass('open')){ 
        $('.registration').addClass(' open');
    }        
    if($('.enter').hasClass('open')){ 
        $('.enter').removeClass(' open');
    }
})

$('.close').click(function () {
    $('.dark_background').removeClass(' open');
    if($('.enter').hasClass('open')){ 
        $('.enter').removeClass(' open');
    }
    if($('.registration').hasClass('open')){ 
        $('.registration').removeClass(' open');
    }
  });

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
        if(login==="" || password==="" || email==="" || phone===""){return;}
        if(pwd_validation(pwd)){
            if(password_repeat_validation(pwd, pwd_repeat)){
                console.log(login+' '+pwd+' '+email+' '+phone);
                return true;
            }
        }
    }
    if($('.enter').hasClass('open')){
        var login = document.enter.login.value;
        var pwd = document.enter.password.value;
        if(login==="" || password===""){return;}
        if(pwd_validation(pwd)){
            console.log(login+' '+pwd);
            return true;
        }
    }
    return false;
}

$('.submit').click(function(e){
    if(!form_validation()){return;}
    e.preventDefault();
    if($('.registration').hasClass('open')){
        var login = document.registration.login.value;
        var password = document.registration.password.value;
        var email = document.registration.email.value;
        var phone = document.registration.phone.value;
        
        $.ajax({
            url: 'reg.php',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login,
                password: password,
                email: email,
                phone: phone
            },
            success(data) {
               if(data.status) {
                }
                else{
                    $('.msg-reg').addClass(' open').text(data.errors[0]);
                }
            }
        })
    }
    if($('.enter').hasClass('open')){
        var login = document.enter.login.value;
        var password = document.enter.password.value;
        $.ajax({
            url: 'enter.php',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login,
                password: password
            },
            success(data) {
                if(data.status){
                }
                else{
                    $('.msg-enter').addClass(' open').text(data.errors[0]);
                }
             }
        })
    }
    return false;
});