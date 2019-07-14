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

<div id="photo-browser">
    <div id="photo-browser-container">
        <table>
            <tr>
                <td>
                    <input type="button" name="" value="Upload new Photo">
                    <input type="button" name="" value="Remove Current Photo">
                    <input type="button" name="" value="Delete this Album">
                    <input type="button" name="" value="Full Preview">
                </td>
                <td align="right">
                    <img src="/assets/images/icons8-delete-16.png" class="close-gallery" title="Close">
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <img src="/assets/images/random.jpg" id="gallery-preview">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left" valign="top">
                    <textarea style="width: 100%; height: 100px;" placeholder="Edit photo Caption here..."></textarea>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <span>20 Photos</span>
                </td>
                <td align="right">
                    <input type="button" value="Save Caption">
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

<script type="text/javascript">
    $(function() {
        $(".remove-icon").on("click", function(){
            app.confirm("Are you sure do you want to delete these 5 photos?");
        });
    });
</script>
