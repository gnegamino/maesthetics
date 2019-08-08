<div id="menu-content">
    <table id="services-container">
        <tr>
            <td valign="top">
                <div id="category-window">
                    <div class="window-title-bar">
                        <table style="width: 100%">
                            <tr>
                                <td align="left">Category</td>
                                <td align="right"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="window-content">
                        <table id="category-table">
                            <?php
                                $data = getData("SELECT * FROM `services`");
                                foreach ($data as $key => $value) {
                                    echo "<tr class='category-row'>";
                                    echo "<td class='category-data' id='category_".$value['id']."'>";
                                    echo $value['name'];
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                            <tr id="category-row">
                                <td id="category-add">+ ADD NEW</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td valign="top">
                <div id="detail-window">
                    <div class="window-title-bar">
                        <table style="width: 100%">
                            <tr>
                                <td align="left">Details</td>
                                <td align="right"><a href="#changebg" id="change-default-background">Set Default Background</a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="window-content detail-content" style="visibility: hidden;">
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <h3 id="category-data-title">SURGERIES</h3>
                                </td>
                                <td align="right">
                                    <a href="#edit" id="categoryedit_1" class="edit_category">Edit</a>
                                    <a href="#" id="categorydelete_1" class="delete_category">Delete this Category</a>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <span>Background Image</span>
                        <hr>
                        <img src="/assets/images/sample-1.jpg" class="category-background-image">
                        <br>
                        <a href="#" id="categorybackgroundedit_1" class="edit_category_background">Change Background</a>
                        <a href="#" id="categorybackgrounddelete_1" class="reset_category_background">Reset Background to Default</a>
                        <br>
                        <br>
                        <br>
                        <span>Featured Services</span>&nbsp;&nbsp;<a href="#" id="new-featured-service">Add New</a>
                        <hr>
                        <div id="featured-services">
                            <?php
                                for ($i=0; $i < 10; $i++) { 
                            ?>
                            <div class="featured-services-item">
                                <table>
                                    <tr>
                                        <td valign="center">
                                            <img src="/assets/images/random.jpg" class="featured-services-thumbnail">
                                        </td>
                                        <td valign="top" style="padding: 5px;">
                                            <span style="font-weight: bold">BOTOX</span>
                                            <p>
                                                This is a facial cosmetic procedure that is usually performed to enhance the appearance of the nose. During this type of rhinoplasty, the nasal cartilage and bones are modified, or tissue is added.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right" class="featured-services-item-controls">
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <br>
                        <br>
                        <span>All Services</span>&nbsp;&nbsp;<a href="#">Add New</a>
                        <hr>
                        <table id="other-services-table">
                            <?php
                                for ($i=0; $i < 10; $i++) { 
                            ?>
                            <tr>
                                <td>
                                    <span>Item 1</span>
                                </td>
                                <td align="right" class="other-services-control">
                                    <a href="#">Edit</a>
                                    <a href="#">Delete</a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>

<div id="text-input-modal" class="modal-body" style="visibility: hidden;">
    <div class="text-input-modal-container">
        <table style="width: 100%">
            <tr>
                <td align="left" id="modal-title">Input Title Here</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="modal-input-text" style="width: 100%">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="button" name="" value="Save" id="modal-save">
                    <input type="button" name="" value="Close" id="modal-close">
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="modal-body" id="default-background-modal" style="visibility: hidden">
    <div id="photo-browser-container">
        <div class="pb-header">
            <div class="pb-header-title">
                Service Default Background
            </div>
            <div class="pb-header-icon">
                <img src="/assets/images/icons8-delete-16.png" class="close-photo-browser" id="close-gallery" title="Close">
            </div>
        </div>
        <div class="pb-content">
            <div class="preview-holder">
                <div style="width: 700px;">
                    <img src="" id="default-background-preview" style="width: 600px; margin-top: 10px;">
                </div>
            </div>
        </div>
        <div class="pb-footer">
            <div class="control-bar">
                <input type="button" value="Change Background" id="change-default-background-button">
            </div>
        </div>
    </div>
</div>

<div id="photo-browser" style="visibility: hidden;">
    <div id="photo-browser-container">
        <div class="pb-header">
            <div class="pb-header-title">
                Featured Service
            </div>
            <div class="pb-header-icon">
                <img src="/assets/images/icons8-delete-16.png" class="close-photo-browser" id="close-gallery-featured" title="Close">
            </div>
        </div>
        <div class="pb-content">
            <div id="thumbnails">
                <table>
                    <tbody>
                        <tr>
                            <td class="thumbnail-small ' + selectedClass + '" id="select_' + id + '">
                                <img src="/assets/images/client-logo.png">
                            </td>
                            <td style="width: 100%" id="thumbnail-small-spacer"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="preview-holder">
                <div><img src="/assets/images/client-logo.png" id="gallery-preview"></div>
            </div>
            <div class="edit-caption">
                <input type="text" id="featured-service-detail-name" style="width: 100%" placeholder="Name/Title">
                <br>
                <br>
                <textarea rows="8" id="featured-service-detail-description" placeholder="Description" id="text-description"></textarea>
            </div>
        </div>
        <div class="pb-footer">
            <div class="control-bar">
                <div class="control-item">
                    <img src="/assets/images/icons8-screen-resolution-26.png" id="full-preview">
                    <span>Full Preview</span>
                </div>
                <div class="control-item">
                    <img src="/assets/images/icons8-preview-pane-26.png" id="save-detail">
                    <span>Set Current Photo as Thumbnail</span>
                </div>
                <div class="control-item">
                    <img src="/assets/images/icons8-remove-image-26.png" id="delete-single-item">
                    <span>Remove Current Photo</span>
                </div>
                <div class="control-item">
                    <img src="/assets/images/icons8-add-image-26.png" id="add-detail">
                    <span>Add Photo</span>
                </div>
                <div class="control-item">
                    <img src="/assets/images/icons8-save-26.png" id="featured-service-detail-save">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="file" id="file-upload-default-background" accept="image/x-png,image/gif,image/jpeg">
<input type="file" id="file-upload-background" accept="image/x-png,image/gif,image/jpeg">

<script type="text/javascript">
    $(function(){
        var modalType = 0;
        var NEW_CATEGORY = 0;
        var EDIT_CATEGORY_NAME = 1;
        var NEW_FEATURED_SERVICE = 2;

        var confirmType = 0;
        var DELETE_SERVICE = 0;
        var RESET_BACKGROUND = 1;
        var DELETE_FEATURED_SERVICE = 2;

        var id = 0;
        var featuredServicesId = 0;

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
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                }
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
</script>