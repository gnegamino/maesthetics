<!DOCTYPE html>
<html>
<head>
    <title>Page Management</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
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