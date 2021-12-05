$('.sign_in').click(function () {
    if(!$('.enter').hasClass('open')){ 
        $('.enter').addClass(' open');
    }        
    if($('.registration').hasClass('open')){ 
        $('.registration').removeClass(' open');
    }
    if($('.msg-reg').hasClass('open')){
        $('.msg-reg').removeClass('open');
    }
})

$('.sign_up').click(function () {
    if(!$('.registration').hasClass('open')){ 
        $('.registration').addClass(' open');
    }        
    if($('.enter').hasClass('open')){ 
        $('.enter').removeClass(' open');
    }
    if($('.msg-enter').hasClass('open')){
        $('.msg-enter').removeClass('open');
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
    if($('.msg-reg').hasClass('open')){
        $('.msg-reg').removeClass('open');
    }
    if($('.msg-enter').hasClass('open')){
        $('.msg-enter').removeClass('open');
    }
  });

  function pwd_validation(pwd, form){
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
    $(form).addClass(' open').text('Password can not be without letters');
    // pwd.focus();
    return false;
}

function password_repeat_validation(pwd, pwd_repeat) {
    if(pwd==pwd_repeat){
        return true;
    }
    $('.msg-reg').addClass(' open').text('Passwords are not equal!');
    // pwd_repeat.focus();
    return false;
}

function form_validation(){
    if($('.registration').hasClass('open')){
        // var login = document.registration.login.value;
        var pwd = document.registration.password.value;
        var pwd_repeat=document.registration.password_repeat.value;
        // var email = document.registration.email.value;
        // var phone = document.registration.phone.value;
        if(pwd_validation(pwd, '.msg-reg')){
            if(password_repeat_validation(pwd, pwd_repeat)){
                // console.log(login+' '+pwd+' '+email+' '+phone);
                return true;
            }
        }
    }
    if($('.enter').hasClass('open')){
        var login = document.enter.login.value;
        var pwd = document.enter.password.value;
        if(pwd_validation(pwd, '.msg-enter')){
            // console.log(login+' '+pwd);
            return true;
        }
    }
    return false;
}

$('.submit').click(function(e){
    if(form_validation()){
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
                        document.location.reload();
                    }
                    else{
                        $('.msg-reg').text("");
                        data.errors.forEach(error => {
                            $('.msg-reg').addClass(' open').append(error);
                            $('.msg-reg').append("<br>");
                        });
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
                        document.location.reload();
                    }
                    else{
                        $('.msg-enter').text("");
                        data.errors.forEach(error => {
                            $('.msg-enter').addClass(' open').append(error);
                            $('.msg-enter').append("<br>");
                        });
                    }
                }
            })
        }
    }
    return false;
});