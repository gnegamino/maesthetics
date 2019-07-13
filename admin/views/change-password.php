<div id="menu-content">
    <table>
        <tr>
            <td align="right">Old Password:</td>
            <td>
                <input type="password" id="old-password">
            </td>
        </tr>
        <tr>
            <td align="right">New Password:</td>
            <td>
                <input type="password" id="new-password">
            </td>
        </tr>
        <tr>
            <td align="right">Repeat Password:</td>
            <td>
                <input type="password" id="repeat-password">
            </td>
        </tr>
        <tr>
            <td></td>
            <td align="right">
                <input type="button" id="save-button" value="Save">
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    $(function() {
        $("#save-button").on("click", function(){
            changePassword();
        });

        function changePassword() {
            app.loading(true);
            $.ajax({
                url: "auth-change-password",
                type: "post",
                data: {
                    oldPassword: $("#old-password").val(),
                    newPassword: $("#new-password").val(),
                    repeatPassword: $("#repeat-password").val()
                },
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        app.alert("success", "Success!");
                        $("#old-password").val("");
                        $("#new-password").val("");
                        $("#repeat-password").val("");
                    } else {
                        app.alert("error", data.message);
                    }
                    app.loading(false);
                }
            });
        }
    });
</script>