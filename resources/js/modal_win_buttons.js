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
    if($('.msg-photo').hasClass('open')){
        $('.msg-photo').removeClass('open');
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

$('.submit_enter').click(function(e){
    if(form_validation()){
        e.preventDefault();
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
    return false;
});


$('.submit_reg').click(function(e){
    if(form_validation()){
        e.preventDefault();
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
});

$('.add_photo_btn').click(function(e) {
    if(!$('.dark_background').hasClass('open')){ 
        $('.dark_background').addClass(' open');
    }
    
    if(!$('.modal_change_btns').hasClass('close')){ 
        $('.modal_change_btns').addClass(' close');
    }
    
    if(!$('.add_photo').hasClass('open')){
        $('.add_photo').addClass(' open');
    }
    // if($('.registration').hasClass('open')){ 
    //     $('.registration').removeClass(' open');
    // }        
    // if($('.enter').hasClass('open')){ 
    //     $('.enter').removeClass(' open');
    // }
    // if($('.msg-enter').hasClass('open')){
    //     $('.msg-enter').removeClass('open');
    // }
    // if($('.msg-reg').hasClass('open')){
    //     $('.msg-reg').removeClass('open');
    // }
});

$('.submit_photo').click(function(e){
    e.stopPropagation();
    e.preventDefault();

    var formData = new FormData(document.getElementById('add_photo'));

    // if(Object.keys(formData).length == 0) {
    //     $('.msg-photo').addClass(' open').text('Form is empty (._.)');
    //     return false;
    // }

    // var name = document.add_photo.photo_name.value;
    // var comment = document.add_photo.photo_comment.value;
    
	
    // $.each( files, function( key, value ){
	// 	data.append( key, value );
	// });

    

    $.ajax({
        url: 'add_photo.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        cache: false,
        data: formData,
        success(data) {
            if(data.status) {
                document.location.reload();
            }
            else{
                $('.msg-photo').text("");
                data.errors.forEach(error => {
                    $('.msg-photo').addClass(' open').append(error);
                    $('.msg-photo').append("<br>");
                });
            }
        }
    })
});