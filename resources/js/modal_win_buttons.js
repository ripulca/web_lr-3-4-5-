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

$('.submit').click(function(){
    if($('.registration').hasClass('open')){
        var login = document.registration.login.value;
        //console.log(document.getElementsByClassName('registration')[0].elements);
        let registerForm = new FormData(document.getElementsByClassName('registration')[0]);
        fetch('/backend/registration.php', {
            method: 'POST',
            body: registerForm
        })
        .then(response => response.json())
        .then((result) => {
        if (result.errors) {
            //вывод ошибок валидации на форму
            login.before(result.errors);
            
        } else {
            //успешная регистрация, обновляем страницу
            $('.registration').removeClass(' open');
            window.location.reload();
        }
        })
        .catch(error => console.warn(error));
    }
    
    if($('.enter').hasClass('open')){
        var login = document.enter.login.value;
        let registerForm = new FormData(document.getElementsByClassName('enter')[0]);
        fetch('/backend/enter.php', {
            method: 'POST',
            body: registerForm
        })
        .then(response => response.json())
        .then((result) => {
        if (result.errors) {
            //вывод ошибок валидации на форму
            login.before(errors);
            
        } else {
            //успешная регистрация, обновляем страницу
            $('.enter').removeClass(' open');
            window.location.reload();
        }
        })
        .catch(error => console.log(error));
    }
});