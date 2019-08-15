$(function(){
    var modalType = 0;
    var NEW_CATEGORY = 0;
    var EDIT_CATEGORY_NAME = 1;
    var NEW_FEATURED_SERVICE = 2;

    var confirmType = 0;
    var DELETE_SERVICE = 0;
    var RESET_BACKGROUND = 1;
    var DELETE_FEATURED_SERVICE = 2;
    var DELETE_FEATURED_PHOTO = 3;
    var THUMBNAIL_FEATURED_PHOTO = 4;

    var id = 0;
    var featuredServicesId = 0;

    var featuredServiceGalleryId = 0;

    var selectedFeaturedServiceHasImage = 0;

    function showInputModal(title, type, content = '')
    {
        modalType = type;
        $("#modal-title").html(title);
        $("#text-input-modal").css("visibility", "visible");
        $("#modal-input-text").val(content);
        $("#modal-input-text").focus();
    }

    $("#modal-close").on("click", function(){
        $("#text-input-modal").css("visibility", "hidden");
    });

    $("#modal-save").on("click", function(){
        submitModal();
    });

    $("#modal-input-text").on("keydown", function(e){
        if (e.which == 13) {
            submitModal();
        }
    });

    function submitModal()
    {
        switch(modalType) {
            case NEW_CATEGORY:
                newCategory();
                break;
            case EDIT_CATEGORY_NAME:
                setCategory();
                break;
            case NEW_FEATURED_SERVICE:
                newFeaturedService();
                break;
            default:
                $("#text-input-modal").css("visibility", "hidden");
                app.loading(true);
                break;
        }
    }

    $("#confirm-yes").on("click", function(){
        $("#confirm").css("visibility", "hidden");
        switch(confirmType) {
            case DELETE_SERVICE:
                deleteSerive();
                break;
            case RESET_BACKGROUND:
                resetBackground();
                break;
            case DELETE_FEATURED_SERVICE:
                deleteFeaturedService();
                break;
            case DELETE_FEATURED_PHOTO:
                deleteFeaturedServicePhoto();
                break;
            case THUMBNAIL_FEATURED_PHOTO:
                thumbnailFeaturedServicePhoto();
                break;
        }
    });

    $("#category-add").on("click", function(){
        showInputModal("Add new Category", NEW_CATEGORY);
    });

    $("#category-table").on("click", ".category-data", function(){
        id = app.getId($(this));
        selectCategory(id)
    });

    $(".edit_category").on("click", function(){
        showInputModal("Edit Category", EDIT_CATEGORY_NAME, $("#category-data-title").html());
    });

    $(".delete_category").on("click", function(){
        confirmType = DELETE_SERVICE;
        app.confirm("Are you sure do you want to delete service category?");
    });

    $("#change-default-background").on("click", function(){
        loadDefaultBackground();
        $("#default-background-modal").css("visibility", "visible");
    });

    $("#close-gallery").on("click", function(){
        $("#default-background-modal").css("visibility", "hidden");
    });

    $("#change-default-background-button").on("click", function(){
        $("#file-upload-default-background").click();
    });

    $("#file-upload-default-background").on("change", function(){
        if ($("#file-upload-default-background").val() == "") {
            return;
        }
        changeDefaultBackground();
    });

    $(".edit_category_background").on("click", function(){
        $("#file-upload-background").click();
    });

    $("#file-upload-background").on("change", function(){
        if ($("#file-upload-background").val() == "") {
            return;
        }
        changeBackground();
    });

    $(".reset_category_background").on("click", function(){
        confirmType = RESET_BACKGROUND;
        app.confirm("Are you sure do you want to reset to default background?");
    });

    $("#new-featured-service").on("click", function(){
        showInputModal("Enter Name/Title (Description and Photos will be added later)", NEW_FEATURED_SERVICE);
    });

    $("#featured-services").on("click", ".featured-services-edit", function(){
        featuredServicesId = app.getId($(this));
        loadFeaturedServiceDetail();
    });

    $("#close-gallery-featured").on("click", function() {
        $("#photo-browser").css("visibility", "hidden");
    });
    
    $("#featured-services").on("click", ".featured-services-delete", function() {
        confirmType = DELETE_FEATURED_SERVICE;
        featuredServicesId = app.getId($(this));
        app.confirm("Are you sure do you want to delete this featured service?");
    });

    $("#featured-service-detail-save").on("click", function() {
        saveFeaturedServiceDetail();
    });

    $("#featured-services-detail-add-photo").on("click", function() {
        $("#file-upload-featured-service").click();
    });

    $("#file-upload-featured-service").on("change", function(){
        if ($("#file-upload-featured-service").val() == "") {
            return;
        }
        addFeatureServicePhoto();
    });

    $("#thumbnails").on("click", ".thumbnail-small", function() {
        $(".thumbnail-small").removeClass("thumbnail-small-selected");
        $(this).addClass("thumbnail-small-selected");
        var path = $("#" + $(this).attr("id") + " img").attr("src");
        featuredServiceGalleryId = app.getId($(this));
        $("#gallery-preview").attr("src", path);
    });

    $("#full-preview").on("click", function(){
        window.open($("#select_" + featuredServiceGalleryId + " img").attr("src"));
    });

    $("#delete-single-item").on("click", function(){
        if (featuredServiceGalleryId != 0) {
            confirmType = DELETE_FEATURED_PHOTO;
            app.confirm("Are you sure do you want to delete this photo?");
        }
    });

    $("#featured-service-detail-set-thumbail").on("click", function(){
        if (featuredServiceGalleryId != 0) {
            confirmType = THUMBNAIL_FEATURED_PHOTO;
            app.confirm("Are you sure do you want to set this photo as thumbnail?");
        }
    });

    function selectCategory(id)
    {
        app.loading(true);
        $.ajax({
            url: "select-service",
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $(".category-data").removeClass("category-data-selected");
                    $("#category_" + id).addClass("category-data-selected");
                    $("#category-data-title").html($("#category_" + id).html());
                    $(".edit_category").attr("id", "categoryedit_" + id);
                    $(".delete_category").attr("id", "categorydelete_" + id);
                    $(".edit_category_background").attr("id", "categorybackgroundedit_" + id);
                    $(".delete_category_background").attr("id", "categorybackgrounddelete_" + id);
                    $("#featured-services").html("");
                    $("#other-services-table").html("");

                    $(".category-background-image").attr("src", data.path);
                    $.each(data.featured_services, function (index, value) {
                        renderFeaturedServiceItem(
                            value.id,
                            value.title,
                            value.description,
                            value.path
                        );
                    });

                    $(".window-content").css("visibility", "visible");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function newCategory()
    {
        app.loading(true);
        $.ajax({
            url: "new-service-category",
            type: "post",
            data: {
                name: $("#modal-input-text").val()
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $('<tr class="category-row">' +
                            '<td class="category-data" id="category_' + data.id + '">' + data.name + '</td>' +
                        '</tr>').insertBefore("#category-row");
                    app.alert("success", "Saved!");
                    $("#modal-input-text").val('');
                    $("#text-input-modal").css("visibility", "hidden");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function setCategory()
    {
        var newName = $("#modal-input-text").val();
        app.loading(true);
        $.ajax({
            url: "set-service-name",
            type: "post",
            data: {
                id: id,
                name: newName
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#category-data-title").html(newName);
                    $("#category_" + id).html(newName);
                    app.alert("success", "Saved!");
                    $("#modal-input-text").val('');
                    $("#text-input-modal").css("visibility", "hidden");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function deleteSerive()
    {
        app.loading(true);
        $.ajax({
            url: "delete-service",
            type: "post",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#featured-services").html("");
                    $("#other-services-table").html("");
                    $(".detail-content").css("visibility", "hidden");
                    $("#category_" + id).parent().remove();
                    app.alert("success", "Deleted");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function loadDefaultBackground()
    {
        app.loading(true);
        $.ajax({
            url: "get-service-default-background",
            type: "post",
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#default-background-preview").attr("src", data.path);
                } else {
                    $("#default-background-preview").attr("src", "");
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function changeDefaultBackground() {
        app.loading(true);
        var fileData = $("#file-upload-default-background").prop("files")[0];
        var formData = new FormData();
        formData.append('file', fileData);

        $.ajax({
            url: "change-service-default-background",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#default-background-preview").attr("src", data.path);
                    app.alert("success", "Success!");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
                $("#file-upload-default-background").val('');
            }
        });
    }

    function changeBackground() {
        app.loading(true);
        var fileData = $("#file-upload-background").prop("files")[0];
        var formData = new FormData();
        formData.append('file', fileData);
        formData.append('id', id);

        $.ajax({
            url: "change-service-background",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $(".category-background-image").attr("src", data.path);
                    app.alert("success", "Success!");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
                $("#file-upload-background").val('');
            }
        });
    }

    function resetBackground()
    {
        app.loading(true);
        $.ajax({
            url: "reset-service-background",
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $(".category-background-image").attr("src", data.path);
                    app.alert("success", "Success!");
                } else {
                    $(".category-background-image").attr("src", data.path);
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function newFeaturedService()
    {
        var title = $("#modal-input-text").val();
        app.loading(true);
        $.ajax({
            url: "new-featured-service",
            type: "post",
            data: {
                id: id,
                name: title
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#modal-input-text").val('');
                    $("#text-input-modal").css("visibility", "hidden");
                    app.alert("success", "Saved!");
                    renderFeaturedServiceItem(
                        data.id,
                        title,
                        "<i>No description has been set</i>",
                        "/assets/images/client-logo.png"
                    );
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function loadFeaturedServiceDetail()
    {
        app.loading(true);
        $.ajax({
            url: "load-featured-service-detail",
            type: "post",
            data: {
                id: featuredServicesId,
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#featured-service-detail-name").val(data.title);
                    $("#featured-service-detail-description").val(data.description);
                    $("#photo-browser").css("visibility", "visible");
                    selectedFeaturedServiceHasImage = data.has_photo;
                    renderFeaturedServicePhotos(data.gallery);
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function renderFeaturedServicePhotos(data)
    {
        $(".thumbnail-small").remove();
        $("#gallery-preview").attr("src", "/assets/images/client-logo.png");
        var selectedClass = "thumbnail-small-selected";
        $.each(data, function (index, value) {
            if (index > 0) {
                selectedClass = "";
            } else {
                $("#gallery-preview").attr("src", value.path);
                featuredServiceGalleryId = value.id;
            }
            if (value.is_thumbnail == 1) {
                selectedClass += " thumbnail-small-display";
            }
            $('<td class="thumbnail-small ' + selectedClass + '" id="select_' + value.id + '">' +
                '<img src="' + value.path + '">' +
            '</td>').insertBefore("#thumbnail-small-spacer");
        });
    }

    function saveFeaturedServiceDetail()
    {
        var name = $("#featured-service-detail-name").val();
        var description = $("#featured-service-detail-description").val();

        app.loading(true);
        $.ajax({
            url: "save-featured-service-detail",
            type: "post",
            data: {
                service: id,
                id: featuredServicesId,
                title: name,
                description: description
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    app.alert("success", "Saved!");
                    $("#featured-service-item_" + featuredServicesId + " span").html(name);
                    if (description.trim() == "") {
                        description = "<i>No description has been set</i>"
                    }
                    $("#featured-service-item_" + featuredServicesId + " p").html(description);
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function deleteFeaturedService()
    {
    }

    function addFeatureServicePhoto()
    {
        app.loading(true);
        var fileData = $("#file-upload-featured-service").prop("files")[0];
        var formData = new FormData();
        formData.append('file', fileData);
        formData.append('id', featuredServicesId);

        $.ajax({
            url: "featured-services-add-photo",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    var selectedClass = "";
                    if (selectedFeaturedServiceHasImage == 0){
                        $(".thumbnail-small").remove();
                        $("#gallery-preview").attr("src", data.path);
                        selectedClass = " thumbnail-small-display";
                        selectedFeaturedServiceHasImage = 1;
                        $("#featured-service-item_" + featuredServicesId + " .featured-services-thumbnail").attr("src", data.path);
                    }
                    $('<td class="thumbnail-small ' + selectedClass + '" id="select_' + data.id + '">' +
                        '<img src="' + data.path + '">' +
                    '</td>').insertBefore("#thumbnail-small-spacer");
                    app.alert("success", "Photo added");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
                $("#file-upload-featured-service").val("");
            }
        });
    }

    function deleteFeaturedServicePhoto()
    {
        app.loading(true);
        $.ajax({
            url: "featured-services-delete-photo",
            type: "post",
            data: {
                id: featuredServiceGalleryId
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $("#select_" + featuredServiceGalleryId).remove();
                    featuredServiceGalleryId = data.thumbnail_id;
                    $("#select_" + data.thumbnail_id).removeClass("thumbnail-small-display");
                    $("#select_" + data.thumbnail_id).removeClass("thumbnail-small-selected");
                    $("#select_" + data.thumbnail_id).addClass("thumbnail-small-display");
                    $("#select_" + data.thumbnail_id).addClass("thumbnail-small-selected");
                    $("#select_" + data.thumbnail_id + " img").attr("src", data.path);
                    if (data.thumbnail_id == 0) {
                          $('<td class="thumbnail-small thumbnail-small-display thumbnail-small-selected" id="0">' +
                                '<img src="' + data.path + '">' +
                            '</td>').insertBefore("#thumbnail-small-spacer");
                    }
                    $("#featured-service-item_" + featuredServicesId + " .featured-services-thumbnail").attr("src", data.path);
                    $("#gallery-preview").attr("src", data.path);
                    app.alert("success", "Deleted");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function thumbnailFeaturedServicePhoto()
    {
        app.loading(true);
        $.ajax({
            url: "featured-services-thumbnail-photo",
            type: "post",
            data: {
                id: featuredServiceGalleryId
            },
            dataType: "json",
            success: function(data){
                if (data.message == "") {
                    $(".thumbnail-small").removeClass("thumbnail-small-display");
                    $("#select_" + featuredServiceGalleryId).addClass("thumbnail-small-display");
                    var path = $("#select_" + featuredServiceGalleryId + " img").attr("src");
                    $("#featured-service-item_" + featuredServicesId + " .featured-services-thumbnail").attr("src", path);
                    app.alert("success", "Success");
                } else {
                    app.alert("error", data.message);
                }
                app.loading(false);
            }
        });
    }

    function renderFeaturedServiceItem(id, title, description, src)
    {
        $("#featured-services").append(
        '<div class="featured-services-item" id="featured-service-item_' + id + '">' +
            '<table>' +
                '<tr>' +
                    '<td valign="center" class="featured-services-thumbnail">' +
                        '<img src="' + src + '" class="featured-services-thumbnail">' +
                    '</td>' +
                    '<td valign="top" style="padding: 5px;">' +
                        '<span style="font-weight: bold">' + title + '</span>' +
                        '<p>' + description + '</p>' +
                    '</td>' +
                '</tr>' +
                '<tr>' +
                    '<td colspan="2" align="right" class="featured-services-item-controls">' +
                        '<a href="#edit" id="featured-services-edit_' + id + '" class="featured-services-edit">Edit</a>' +
                        '<a href="#delete" id="featured-services-delete_' + id + '" class="featured-services-delete">Delete</a>' +
                    '</td>' +
                '</tr>' +
            '</table>' +
        '</div>');
    }
});