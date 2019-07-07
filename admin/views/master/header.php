<!DOCTYPE html>
<html>
<head>
    <title>Content Editor</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
    <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        var app = {};
        $(function(){
            app.loading = function loading(status) {
                if (status) {
                    $("#loading").css("visibility", "visible");
                    $("input").attr("disabled", "disabled");
                } else {
                    $("#loading").css("visibility", "hidden");
                    $("input").removeAttr("disabled");
                }
            }

            $("#goto-about").on("click", function(){
                window.location = "about";
            });
            $("#goto-gallery").on("click", function(){
                window.location = "gallery";
            });
            $("#goto-change-password").on("click", function(){
                window.location = "change-password";
            });

        });
    </script>
    <div id="loading">
        <img src="assets/images/loading.gif">
    </div>
    <div id="container">
        <div id="navigation-bar">
            <div class="stretch title">
                <span id="client-name">M AESTHETICS</span>
                <span id="system-name">PAGE MANAGEMENT</span>
            </div>
            <div class="stretch navigation-bar-container">
                <?php
                    if (isset($_SESSION['login'])) {
                ?>
                    <div>
                        <a href="http://www.demo.truckingcwlt.com/" target="_blank">Website Preview</a>
                        &nbsp;
                        |
                        &nbsp;
                        <a href="logout">Logout</a>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div id="content">
            <?php
                if (isset($_SESSION['login'])) {
            ?>
                <div id="app-container">
                    <div id="side-bar">
                        <div class="side-bar-item" id="goto-about">
                            About Content
                        </div>
                        <div class="side-bar-item" id="goto-gallery">
                            Gallery
                        </div>
                        <div class="side-bar-item" id="goto-change-password">
                            Change Password
                        </div>
                    </div>
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