$(function(){
    $(window).scrollTop(0);

    $(window).scroll(function(e){
        var scroll = $(window).scrollTop();
        if (scroll > 670) {
            $('#sub-navigation-bar').css({
                'visibility': 'visible',
                'opacity': 1
            });
        } else {
            $('#sub-navigation-bar').css({
                'visibility': 'hidden',
                'opacity': 0
            });
        }
    });

    $('#toggle-menu').click(function(){
        var menu = $('.mini-dropdown-navigation .dropdown-navigation').css('display');

        if (menu == "none") {
            $('.mini-dropdown-navigation .dropdown-navigation').slideDown();
        } else {
            $('.mini-dropdown-navigation .dropdown-navigation').slideUp();
        }
    });
});