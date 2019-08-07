<div id="login-container">
    <div id="login-form">
        <table>
            <tr>
                <td align="center">
                    <img id="client-logo" src="assets/images/client-logo.png">
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <span id="error-label"></span>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="password" name="password" id="password-input">
                    <input type="button" name="login" id="login-button" value="Login">
                </td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $("#password-input").focus();

        $("#login-button").on("click", function(){
            login();
        });

        $("#password-input").on("keydown", function(e){
            if (e.which == 13) {
                login();
            }
        });

        function login() {
            app.loading(true);
            $.ajax({
                url: "auth",
                type: "post",
                data: {
                    password: $("#password-input").val()
                },
                dataType: "json",
                success: function(data){
                    if (data.message == "") {
                        window.location = "gallery";
                    } else {
                        app.alert("error", data.message);
                        app.loading(false);
                    }
                }
            });
        }
    });
</script>