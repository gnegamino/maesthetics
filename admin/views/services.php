<div id="menu-content">
    <table id="services-container">
        <tr>
            <td valign="top">
                <div id="category-window">
                    <div class="window-title-bar">Category</div>
                    <div class="window-content">
                        <table id="category-table">
                            <?php
                                $data = getData("SELECT * FROM `Services`");
                                foreach ($data as $key => $value) {
                                    echo "<tr><td id='category_".$value['id']."'>";
                                    echo $value['name'];
                                    echo "</td></tr>";
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
                    <div class="window-title-bar">Details</div>
                    <div class="window-content">
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <h3>SURGERIES</h3>
                                </td>
                                <td align="right">
                                    <a href="#">Edit</a>
                                    <a href="#">Delete this Category</a>
                                </td>
                            </tr>
                        </table>
                        <br>

                        <span>Background Image</span>
                        <hr>
                        <img src="/assets/images/sample-1.jpg" class="category-background-image">
                        <br>
                        <br>
                        <br>
                        <span>Featured Services</span>
                        <hr>
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
                        <br>
                        <br>
                        <span>Other Services</span>
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

<script type="text/javascript">
    $(function(){

        var modalType = 0;

        function showInputModal(title, type)
        {
            modalType = type;
            $("#modal-title").html(title);
            $("#text-input-modal").css("visibility", "visible");
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
                case 0:
                    newCategory();
                    break;
                default:
                    $("#text-input-modal").css("visibility", "hidden");
                    app.loading(true);
                    break;
            }
        }

        $("#category-add").on("click", function(){
            showInputModal("Add new Category", 0);
        });

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
                        $('<tr><td id="category_' + data.id + '">' + data.name + '</td></tr>').insertBefore("#category-row");
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
    });
</script>