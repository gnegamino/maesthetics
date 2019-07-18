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
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-surgeries.jpg")');
    }).mouseout(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-black-1.jpg")');
    });

    $("#face-skin-body").mouseover(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-face-body.jpg")');
    }).mouseout(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-black-1.jpg")');
    });

    $("#lasers-machines").mouseover(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-lasers.jpg")');
    }).mouseout(function() {
        $('.page-banner').css('background-image', 'url("/assets/images/static/bg-black-1.jpg")');
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

    $('.media-gallery-item').click(function(){
        var mediaGalleryItem = $(this).data('media-gallery-item');

        $('#gallery-modal').modal('show');
        
        if (mediaGalleryItem == "single") {
            $('#gallery-modal .single-image').show();
            $('#gallery-modal .album').hide();
        } else {
            $('#gallery-modal .album').show();
            $('#gallery-modal .single-image').hide();
        }
    });
});

function processing(state) {
    if (state) {
        document.body.style.overflow = "hidden";
        document.querySelector('.processing').style.display = "block";
    } else {
        document.body.style.overflow = "auto";
        document.querySelector('.processing').style.display = "none";
    }
}