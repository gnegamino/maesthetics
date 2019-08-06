<!DOCTYPE html>
<html>
<head>
    <title>Page Management</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/m-aesthetics.ico"/>
</head>
<body>
    <script type="text/javascript" src="/assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        var app = {};
        var timeOut;
        $(function(){

            app.closeAlert = function closeAlert() {
                clearTimeout(timeOut);
                $("#alert").css("visibility", "hidden");
            }

            app.alert = function alert(type, message) {
                var icon = '/assets/images/icons8-ok-40.png';
                if (type == 'error') {
                    icon = '/assets/images/icons8-error-40.png';
                }
                $("#alert-icon").attr("src", icon);
                $("#alert-message").html(message);
                app.closeAlert();
                $("#alert").css("visibility", "visible");
                timeOut = setTimeout(function(){ $("#alert").css("visibility", "hidden"); }, 3000);
            }

            app.confirm = function confirm(message) {
                $("#confirm-message").html(message);
                $("#confirm").css("visibility", "visible");
            }

            $("#confirm-no").on("click", function(){
                $("#confirm").css("visibility", "hidden");
            });

            app.loading = function loading(status) {
                if (status) {
                    app.closeAlert();
                    $("#loading").css("visibility", "visible");
                    $("input").attr("disabled", "disabled");
                } else {
                    $("#loading").css("visibility", "hidden");
                    $("input").removeAttr("disabled");
                }
            }

            app.getId = function getId(element) {
                var parts = $(element).attr("id").split('_');
                return parts[parts.length - 1];
            }
        });
    </script>
    <div id="loading">
        <img src="/assets/images/loading.gif">
    </div>
    <div id="alert" style="visibility: hidden;">
        <div id="alert-container">
            <table>
                <tr>
                    <td style="width: 50px;">
                        <img src="/assets/images/icons8-ok-40.png" id="alert-icon" style="margin-top: 7px">
                    </td>
                    <td style="width: 350px; padding: 10px">
                        <span id="alert-message">Successful!</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="confirm" style="visibility: hidden;">
         <div id="confirm-container">
            <table>
                <tr>
                    <td style="width: 50px;">
                        <img src="/assets/images/icons8-ask-question-40.png" id="confirm-icon">
                    </td>
                    <td style="width: 350px; padding: 10px">
                        <span id="confirm-message">Are you sure do you want to delete these 5 photos?</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input type="button" id="confirm-yes" value="Yes">
                        <input type="button" id="confirm-no" value="No">
                    </td>
                </tr>
            </table>
         </div>
    </div>
    <div id="container">
        <div id="navigation-bar">
            <div class="stretch title">
                <span id="client-name">M AESTHETICS</span>
                <span id="system-name">PAGE MANAGEMENT</span>
            </div>
            <div class="stretch navigation-bar-container">
                <?php
                    if (auth()) {
                ?>
                    <div>
                        <a href="http://maestheticsclinic.com/" target="_blank">
                            Website Preview
                        </a>
                        &nbsp;
                        |
                        &nbsp;
                        <a href="logout">
                            Logout
                        </a>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div id="content">
            <?php
                if (auth()) {
            ?>
                <div id="app-container">
                    <?php
                        require 'views/sidebar.php';
                    ?>
                    <div id="contents">
                        <div id="content-title">
                            <div>
                                <span class="menu-title">
                                    <?php echo ucwords(str_replace('-', ' ', $_GET['uri'])); ?>
                                </span>
                            </div>
                        </div>
                        <div id="content-space">
            <?php } ?>