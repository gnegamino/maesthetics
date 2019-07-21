<div id="menu-content">
    <div class="gallery">

        <?php
            global $fileConfig;

            $query = 'SELECT
                        P.`id`,
                        COUNT(C.`id`) + 1 AS `total`,
                        P.`path`
                    FROM `gallery` AS P
                    LEFT JOIN `gallery` AS C ON C.`parent_id` = P.`id`
                    WHERE P.`parent_id` = 0
                    GROUP BY P.`id`
                    ORDER BY P.`created_at`';
            $data = getData($query);

            foreach ($data as $key => $value) {
        ?>

        <div class="gallery-item" id="item_<?php echo $value['id']; ?>">
            <table>
                <tr>
                    <td align="left" class="thumbnail-label-count"><?php echo photoCountLabel($value['total']); ?></td>
                    <td align="right">
                        <img src="/assets/images/icons8-delete-trash-16.png" class="remove-icon" title="Delete" id="delete_<?php echo $value['id']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="thumbnail-holder">
                        <img src="/<?php echo $fileConfig['storage_path'].$value['path']; ?>" class="thumbnail" id="show_<?php echo $value['id']; ?>">
                    </td>
                </tr>
            </table>
        </div>

        <?php
            }
        ?>
        <div class="gallery-item-add">
            <img src="/assets/images/icons8-add-image-100.png">
        </div>
    </div>
</div>

<div id="photo-browser" style="visibility: hidden;">
    <div id="photo-browser-container">
        <div class="pb-header">
            <div class="pb-header-title">
                Preview
            </div>
            <div class="pb-header-icon">
                <img src="/assets/images/icons8-delete-16.png" id="close-gallery" title="Close">
            </div>
        </div>
        <div class="pb-content">
            <div id="thumbnails">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 100%" id="thumbnail-small-spacer"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="preview-holder">
                <div><img src="" id="gallery-preview"></div>
            </div>
            <div class="edit-caption">
                <textarea rows="8" placeholder="Edit photo Caption here..." id="text-description"></textarea>
            </div>
        </div>
        <div class="pb-footer">
            <div class="control-bar">
                <div class="control-item">
                    <img src="/assets/images/icons8-screen-resolution-26.png" id="full-preview">
                    <span>Full Preview</span>
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
                    <img src="/assets/images/icons8-save-26.png" id="save-detail">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="file" id="file-upload" accept="image/x-png,image/gif,image/jpeg">
<input type="file" id="file-upload-detail" accept="image/x-png,image/gif,image/jpeg">

<script type="text/javascript">
    $(function() {

        var id = 0;
        var which = 0;

        $(".gallery").on("click", ".remove-icon", function(){
            which = 0;
            var parts = $(this).attr("id").split('_');
            id = parts[1];
            app.confirm("Are you sure do you want to delete this album?");
        });

        $(".gallery").on("click", ".thumbnail", function(){
            var parts = $(this).attr("id").split('_');
            id = parts[1];
            view(id);
        });

        $("#close-gallery").on("click", function() {
            $("#photo-browser").css("visibility", "hidden");
            app.loading(true);
            location.reload();
        });

        $(".gallery-item-add").on("click", function(){
            $("#file-upload").click();
        });

        $("#file-upload").on("change", function(){
            if ($("#file-upload").val() == "") {
                return;
            }
            createAlbum();
        });

        $("#add-detail").on("click", function(){
            $("#file-upload-detail").click();
        });

        $("#file-upload-detail").on("change", function(){
            if ($("#file-upload-detail").val() == "") {
                return;
            }
            createDetail();
        });

        $("#thumbnails").on("click", ".thumbnail-small", function() {
            $(".thumbnail-small").removeClass("thumbnail-small-selected");
            $(this).addClass("thumbnail-small-selected");
            var path = $("#" + $(this).attr("id") + " img").attr("src");
            $("#gallery-preview").attr("src", path);

            var parts = $(this).attr("id").split('_');
            id = parts[1];
            loadDetail();
        });

        $("#save-detail").on("click", function() {
            saveDescription();
        });

        $("#full-preview").on("click", function(){
            window.open($("#select_" + id + " img").attr("src"));
        });

        $("#delete-single-item").on("click", function(){
            which = 1;
            app.confirm("Are you sure do you want to delete this photo?");
        });

        $("#confirm-yes").on("click", function(){
            $("#confirm").css("visibility", "hidden");
            if (which == 0) {
                deleteAlbum();
            } else {
                deletePhoto();
            }
        });

        function deleteAlbum() {
            app.loading(true);
            $.ajax({
                url: "delete-album",
                type: "post",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        app.alert("success", "Deleted");
                        location.reload();
                    } else {
                        app.alert("error", data.message);
                        app.loading(false);
                    }
                }
            });
        }

        function deletePhoto() {
            app.loading(true);
            $.ajax({
                url: "delete-item",
                type: "post",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        app.alert("success", "Deleted");
                        if (data.reload) {
                            $("#photo-browser").css("visibility", "hidden");
                            location.reload();
                        } else {
                            displayDetails(data.items);
                            $("#gallery-preview").attr("src", data.items[0].path);
                            id = data.items[0].id;
                            $("#text-description").val(data.items[0].description);
                        }
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                }
            });
        }

        function saveDescription() {
            app.loading(true);
            $.ajax({
                url: "save-item-description",
                type: "post",
                data: {
                    id: id,
                    description: $("#text-description").val()
                },
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        app.alert("success", "Saved.");
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                }
            });
        }

        function loadDetail() {
            app.loading(true);
            $.ajax({
                url: "get-item-description",
                type: "post",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        $("#text-description").val(data.description);
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                }
            });
        }

        function view(id) {
            app.loading(true);
            $.ajax({
                url: "view-album",
                type: "post",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        displayDetails(data.items);
                        $("#gallery-preview").attr("src", data.items[0].path);
                        id = data.items[0].id;
                        $("#text-description").val(data.items[0].description);
                        $("#photo-browser").css("visibility", "visible");
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                    $("#file-upload-detail").val('');
                }
            });
        }

        function displayDetails(items) {
            $(".thumbnail-small").remove();
            var count = items.length;
            for (var i = 0; i < items.length; i++) {
                generateAlbumElementDetail(items[i].id, items[i].path, i == 0);
            }
        }

        function createDetail() {
            app.loading(true);
            var fileData = $("#file-upload-detail").prop("files")[0];
            var formData = new FormData();
            formData.append('id', id);
            formData.append('file', fileData);

            $.ajax({
                url: "create-album-detail",
                type: "post",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        app.alert("success", "Success!");
                        generateAlbumElementDetail(data.id, data.path);
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                    $("#file-upload-detail").val('');
                }
            });
        }

        function generateAlbumElementDetail(id, path, selected = false) {
            var selectedClass = "";
            if (selected) {
                selectedClass = "thumbnail-small-selected";
            }
            $('<td class="thumbnail-small ' + selectedClass + '" id="select_' + id + '">' +
                '<img src="/' + path + '">' +
            '</td>').insertBefore("#thumbnail-small-spacer");
        }

        function createAlbum() {
            app.loading(true);
            var fileData = $("#file-upload").prop("files")[0];
            var formData = new FormData();
            formData.append('file', fileData);

            $.ajax({
                url: "create-album",
                type: "post",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        app.alert("success", "Success!");
                        generateAlbumElement(data.id, data.path);
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                    $("#file-upload").val('');
                }
            });
        }

        function generateAlbumElement(id, path) {
            $('<div class="gallery-item">' +
                '<table>' +
                    '<tr>' +
                        '<td align="left" class="thumbnail-label-count">1 Photo</td>' +
                        '<td align="right">' +
                            '<img src="/assets/images/icons8-delete-trash-16.png" class="remove-icon" title="Delete" id="delete_' + id + '">' +
                        '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="2" class="thumbnail-holder">' +
                            '<img src="' + path + '" class="thumbnail" id="show_' + id+ '" >' +
                        '</td>' +
                    '</tr>' +
                '</table>' +
            '</div>').insertBefore('.gallery-item-add');
        }
    });
</script>
