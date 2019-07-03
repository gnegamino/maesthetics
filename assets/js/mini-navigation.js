$(function(){
    $(window).scrollTop(0);

    $('#toggle-menu').click(function(){
        var menu = $('.mini-dropdown-navigation .dropdown-navigation').css('display');

        if (menu == "none") {
            $('.mini-dropdown-navigation .dropdown-navigation').slideDown();
        } else {
            $('.mini-dropdown-navigation .dropdown-navigation').slideUp();
        }
    });

    $("#surgeries").mouseover(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/breast-1.JPG")');
    }).mouseout(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-black-1.JPG")');
    });
});