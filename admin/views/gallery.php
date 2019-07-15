<div id="menu-content">
    <div class="gallery">
        <div class="gallery-item">
            <table>
                <tr>
                    <td align="left" class="thumbnail-label-count">5 Photos</td>
                    <td align="right">
                        <img src="/assets/images/icons8-delete-trash-16.png" class="remove-icon" title="Delete" id="delete_1">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <img src="/assets/images/random.jpg" class="thumbnail">
                    </td>
                </tr>
            </table>
        </div>
        <div class="gallery-item">
            <table>
                <tr>
                    <td align="left" class="thumbnail-label-count">1 Photo</td>
                    <td align="right">
                        <img src="/assets/images/icons8-delete-trash-16.png" class="remove-icon" title="Delete" id="delete_2">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <img src="/assets/images/random.jpg" class="thumbnail">
                    </td>
                </tr>
            </table>
        </div>
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
                <td align="center" colspan="2">
                    <img src="/assets/images/random.jpg" id="gallery-preview">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left" valign="top">
                    <textarea style="width: 670px; height: 60px;" placeholder="Edit photo Caption here..."></textarea>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <span>20 Photos</span>
                </td>
                <td align="right">
                    <table class="control-bar">
                        <tr>
                            <td class="control-item">
                                <img src="/assets/images/icons8-screen-resolution-26.png">
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
                                <img src="/assets/images/icons8-add-image-26.png">
                                <span>Add Photo</span>
                            </td>
                            <td class="control-item">
                                <img src="/assets/images/icons8-save-26.png">
                                <span>Save</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="thumbnails">
                        <table>
                            <tr>
                                <?php for ($i = 0; $i < 20; $i++) { ?>
                                <td>
                                    <img src="/assets/images/random.jpg" class="thumbnail-small">
                                </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<input type="file" id="file-upload" accept="image/x-png,image/gif,image/jpeg">

<script type="text/javascript">
    $(function() {
        $(".remove-icon").on("click", function(){
            app.confirm("Are you sure do you want to delete these 5 photos?");
        });

        $(".thumbnail").on("click", function(){
            $("#photo-browser").css("visibility", "visible");
        });

        $("#close-gallery").on("click", function(){
            $("#photo-browser").css("visibility", "hidden");
        });

        $(".gallery-item-add").on("click", function(){
            $("#file-upload").click();
        });

        $("#file-upload").on("change", function(){
            createAlbum();
        });

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
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                }
            });
        }
    });
</script>
