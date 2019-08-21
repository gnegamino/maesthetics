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
                        <span>All Services</span>&nbsp;&nbsp;<a href="#addNewServiceAll" id="add-new-service-all">Add New</a>
                        <hr>
                        <div id="tree">
                        </div>
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
                <table id="gallery-table">
                    <tbody>
                        <tr>
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
                    <img src="/assets/images/icons8-preview-pane-26.png" id="featured-service-detail-set-thumbail">
                    <span>Set Current Photo as Thumbnail</span>
                </div>
                <div class="control-item">
                    <img src="/assets/images/icons8-remove-image-26.png" id="delete-single-item">
                    <span>Remove Current Photo</span>
                </div>
                <div class="control-item">
                    <img src="/assets/images/icons8-add-image-26.png" id="featured-services-detail-add-photo">
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
<input type="file" id="file-upload-featured-service" accept="image/x-png,image/gif,image/jpeg">

<script src="/assets/js/modules/services.js"></script>