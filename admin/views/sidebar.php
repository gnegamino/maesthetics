<div id="side-bar">
     <div class="side-bar-item" id="goto-gallery">
        <img src="/assets/images/icons8-gallery-16.png">
        <span>Gallery</span>
    </div>
    <div class="side-bar-item" id="goto-about">
        <img src="/assets/images/icons8-about-16.png">
        <span>About Content</span>
    </div>
    <div class="side-bar-item" id="goto-services">
        <img src="/assets/images/icons8-list-view-16.png">
        <span>Services Content</span>
    </div>
    <div class="side-bar-item" id="goto-change-password">
        <img src="/assets/images/icons8-password-16.png">
        <span>Change Password</span>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $("#goto-about").on("click", function(){
            window.location = "about";
        });
        $("#goto-gallery").on("click", function(){
            window.location = "gallery";
        });
        $("#goto-change-password").on("click", function(){
            window.location = "change-password";
        });
        $("#goto-services").on("click", function(){
            window.location = "services";
        });
    });
</script>
