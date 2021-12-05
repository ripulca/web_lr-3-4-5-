$('.header_nav_auth_btn').click(function () {
    if(!$('.dark_background').hasClass('open')){ 
        $('.dark_background').addClass(' open');
        $('.enter').addClass(' open');
    }
})

$('.add_content_btn').click(function(){
    photoPerPage=9;
    lastId = $('.photo_card').filter(':last').attr('data-id');
    pageNum=parseInt((parseInt(lastId)+1)/photoPerPage);
    lastLine=$('.main_photos_row').filter(':last');
    $.ajax({
        url:'php/photo_gen.php?page=' + pageNum,  
        method: 'get', 
        dataType: 'html',
        success:function(data){
            lastLine.after(data);
        }
    });
});

$('.dark_background').mouseup(function (e) {
    let modal_win = $(".modal_win");
    if (!modal_win.is(e.target) && modal_win.has(e.target).length === 0) {
        $('.dark_background').removeClass(' open');
        if($('.enter').hasClass('open')){ 
            $('.enter').removeClass(' open');
        }
        if($('.registration').hasClass('open')){ 
            $('.registration').removeClass(' open');
        }
    }
});