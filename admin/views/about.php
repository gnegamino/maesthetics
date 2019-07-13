<script src="assets/js/ckeditor/ckeditor.js"></script>
<div id="menu-content">
    <textarea name="editor1" id="editor1" rows="15" cols="80">
        <?php echo getData("SELECT `content` FROM `content` WHERE `module` ='about'")[0]['content']; ?>
    </textarea>
    <hr>
    <input type="button" id="save-edit-button" value="Save">
    <script>
        CKEDITOR.replace('editor1');
    </script>
</div>

<script type="text/javascript">
    $(function() {
        $("#save-edit-button").on("click", function(){
            saveEdit();
        });

        function saveEdit() {
            app.loading(true);
            $.ajax({
                url: "about-save-edit",
                type: "post",
                data: {
                    data: CKEDITOR.instances.editor1.getData(),
                },
                dataType: "json",
                success: function(data){
                    app.alert("success", "Saved");
                    app.loading(false);
                }
            });
        }
    });
</script>