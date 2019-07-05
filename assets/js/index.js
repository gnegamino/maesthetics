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

    // SERVICES
    $("#surgeries").mouseover(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-surgeries.JPG")');
    }).mouseout(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-black-1.JPG")');
    });

    $("#face-skin-body").mouseover(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-face-body.JPG")');
    }).mouseout(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-black-1.JPG")');
    });

    $("#lasers-machines").mouseover(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-lasers.JPG")');
    }).mouseout(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-black-1.JPG")');
    });

    $(".view-more").click(function(){
        var mediaName = $(this).closest('.media-item').data('media-name');
        $("#preview-modal").modal('show');
        $("#preview-modal .modal-title").html(mediaName);
        $("#preview-modal .media-preview").removeClass('active');
        $("#preview-modal .media-preview[data-media-name='"+ mediaName +"']").addClass('active');
    });

    $(".media-box-header").click(function(){
        var mediaHeader = $(this).closest('.media-box-item').find('.media-box-header');
        var mediaContent = $(this).closest('.media-box-item').find('.media-box-content');

        if (mediaContent.css('display') == "none") {
            mediaHeader.find('.media-box-header-icon i').removeClass('fa-plus').addClass('fa-minus');
            mediaContent.slideDown();
        } else {
            mediaHeader.find('.media-box-header-icon i').removeClass('fa-minus').addClass('fa-plus');
            mediaContent.slideUp();
        }
    });
});