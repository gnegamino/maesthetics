<div id="menu-content">
    <table id="services-container">
        <tr>
            <td valign="top">
                <div id="category-window">
                    <div class="window-title-bar">Category</div>
                    <div class="window-content">
                        <table id="category-table">
                            <tr>
                                <td class="category-selected">SURGERIES</td>
                            </tr>
                            <tr>
                                <td>FACE, SKIN AND BODY</td>
                            </tr>
                            <tr>
                                <td>LASERS AND MACHINES</td>
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
                                        <a href="#">Edit Photos</a>
                                        <a href="#">Edit Description</a>
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

<style type="text/css">
    #services-container {
        width: 100%;
        height: 100%
    }

    .window-title-bar {
        color: #171717;
        border-bottom: solid 3px #171717;
        padding: 5px;
        font-weight: bold;
    }

    .window-content {
        padding: 10px;
        height: 100%;
        overflow-y: scroll;
    }

    #category-window {
        width: 300px;
        height: calc(100vh - 155px);
        height: -webkit-calc(100vh - 155px);
        height: -moz-calc(100vh - 155px);
        height: -o-calc(100vh - 155px);
    }

    #detail-window {
        width: calc(100vw - 535px);
        width: -webkit-calc(100vw - 535px);
        width: -moz-calc(100vw - 535px);
        width: -o-calc(100vw - 535px);
        height: calc(100vh - 155px);
        height: -webkit-calc(100vh - 155px);
        height: -moz-calc(100vh - 155px);
        height: -o-calc(100vh - 155px);
    }

    #detail-window a{
        padding-left: 5px;
        font-size: 12px;
    }

    #category-table {
        width: 100%;
    }

    #category-table td{
        padding: 7px;
        width: 100%;
        cursor: pointer;
    }

    #category-table td:hover, .category-selected{
        background-color: #1f1f1f;
        color: #fff;
    }

    .category-background-image {
        max-width: calc(100vw - 580px);
        max-width: -webkit-calc(100vw - 580px);
        max-width: -moz-calc(100vw - 580px);
        max-width: -o-calc(100vw - 580px);
    }

    .featured-services-item {
        display: block;
        background-color: #fff;
        padding: 10px;
        margin-top: 5px;
    }

    .featured-services-thumbnail {
        width: 100px;
    }

    #other-services-table {
        width: 100%;
    }

    #other-services-table td{
        padding: 5px;
    }

    #other-services-table tr:hover span{
        color: #4f4f4f;
    }

    .other-services-control {
        width: 100px;
    }

</style>