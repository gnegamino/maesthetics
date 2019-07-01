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
});