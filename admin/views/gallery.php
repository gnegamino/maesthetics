<div id="menu-content">
    <div class="gallery">

        <?php
            global $fileConfig;

            $query = 'SELECT
                        P.`id`,
                        COUNT(P.`id`) AS `total`,
                        P.`path`
                    FROM `gallery` AS P
                    LEFT JOIN `gallery` AS C ON C.`parent_id` = P.`id`
                    WHERE P.`parent_id` = 0
                    GROUP BY P.`id`';
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
        <table>
            <tr>
                <td>Preview</td>
                <td align="right">
                    <img src="/assets/images/icons8-delete-16.png" id="close-gallery" title="Close">
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2" class="preview-holder">
                    <div>
                        <img src="" id="gallery-preview">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left" valign="top">
                    <textarea style="width: 670px; height: 60px;" placeholder="Edit photo Caption here..." id="text-description"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="thumbnails">
                        <table>
                            <tbody>
                                <tr>
                                    <td style="width: 100%" id="thumbnail-small-spacer"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <span id="detail-count"></span>
                </td>
                <td align="right">
                    <table class="control-bar">
                        <tr>
                            <td class="control-item">
                                <img src="/assets/images/icons8-screen-resolution-26.png" id="full-preview">
                                <span>Full Preview</span>
                            </td>
                            <td class="control-item">
                                <img src="/assets/images/icons8-delete-trash-26.png">
                                 <span>Delete Album</span>
                            </td>
                            <td class="control-item">
                                <img src="/assets/images/icons8-remove-image-26.png">
                                <span>Remove Current Photo</span>
                            </td>
                            <td class="control-item">
                                <img src="/assets/images/icons8-add-image-26.png" id="add-detail">
                                <span>Add Photo</span>
                            </td>
                            <td class="control-item">
                                <img src="/assets/images/icons8-save-26.png" id="save-detail">
                                <span>Save</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<input type="file" id="file-upload" accept="image/x-png,image/gif,image/jpeg">
<input type="file" id="file-upload-detail" accept="image/x-png,image/gif,image/jpeg">

<script type="text/javascript">
    $(function() {

        var id = 0;
        var parent_id = 0;

        $(".gallery").on("click", ".remove-icon", function(){
            app.confirm("Are you sure do you want to delete these 5 photos?");
        });

        $(".gallery").on("click", ".thumbnail", function(){
            var parts = $(this).attr("id").split('_');
            id = parts[1];
            parent_id = id;
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
