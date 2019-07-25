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
        var parts = $(this).attr("id").split('_');
        var id = parts[1];

        if (mediaGalleryItem == "single") {
            loadSingleImage(id);
        } else {
            loadAlbum(id);
        }
    });

    function loadSingleImage(id) {
        processing(true);
        $.ajax({
            url: "get-gallery-item",
            type: "post",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $(".single-image img").attr("src", data.item.path);
                    $(".single-image div").html(data.item.description);
                    $('#gallery-modal').modal('show');
                    $('#gallery-modal .single-image').show();
                    $('#gallery-modal .album').hide();
                } else {
                    alert(data.message);
                }
                processing(false);
            }
        });
    }

    function loadAlbum(id) {
        processing(true);
        $.ajax({
            url: "get-gallery-album",
            type: "post",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#album-indicators").empty();
                    $("#album-items").empty();
                    for (var i = 0; i < data.items.length; i++) {
                        var active = i == 0 ? 'class="active"' : '';
                        $("#album-indicators").append('<li data-target="#carousel-example-generic" data-slide-to="' + i + '" ' + active + '></li>');
                        active = i == 0 ? 'active' : '';
                        $("#album-items").append('<div class="item ' + active + '">' +
                                '<img src="' + data.items[i].path + '">' +
                                '<div class="carousel-caption">' +
                                    data.items[i].description +
                                '</div>' +
                            '</div>');
                    }
                    $('#gallery-modal').modal('show');
                    $('#gallery-modal .album').show();
                    $('#gallery-modal .single-image').hide();
                } else {
                    alert(data.message);
                }
                processing(false);
            }
        });
    }

    $('#contact-send-button').click(function(){
        var contactName = $("#contact-name-text").val();
        var contactNumber = $("#contact-number-text").val();
        var contactAddress = $("#contact-address-text").val();
        var contactRemarks = $("#contact-remarks-text").val();

        $("#alert-error").css("display", "none");
        $("#alert-success").css("display", "none");

        processing(true);
        $.ajax({
            url: "send-inquiry",
            type: "post",
            data: {
                contactName: contactName,
                contactNumber: contactNumber,
                contactAddress: contactAddress,
                contactRemarks: contactRemarks
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#alert-success").css("display", "block");
                    $("#contact-name-text").val("");
                    $("#contact-number-text").val("");
                    $("#contact-address-text").val("");
                    $("#contact-remarks-text").val("");
                } else {
                    $("#alert-error").html(data.message);
                    $("#alert-error").css("display", "block");
                }
                processing(false);
            }
        });
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