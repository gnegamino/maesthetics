<?php
    require_once('layouts/master_header.php');
    require_once('layouts/sub-navigation.php');
?>

<div class="container-fluid gallery">
    <div class="row">
        <div class="col-md-12 page-banner">
            <h1>Gallery</h1>
        </div>
    </div>
    <div class="row media-gallery-section">
        <div class="container">
            <div class="media-gallery">
                <?php
                    global $fileConfig;

                    $query = 'SELECT
                                P.`id`,
                                COUNT(C.`id`) + 1 AS `count`,
                                P.`path`
                            FROM `gallery` AS P
                            LEFT JOIN `gallery` AS C ON C.`parent_id` = P.`id`
                            WHERE P.`parent_id` = 0
                            GROUP BY P.`id`
                            ORDER BY P.`created_at`';
                    $data = getData($query);

                    foreach ($data as $key => $value) {
                        $type =  $value['count'] > 1 ? 'album' : 'single';
                        $path = $fileConfig['storage_path'].$value['path'];
                ?>
                    <div class="col-md-3">
                        <div class="media-gallery-item" data-media-gallery-item="<?php echo $type; ?>" id="item_<?php echo $value['id']; ?>">
                            <img src="<?php echo $path; ?>">
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require_once('layouts/master_footer.php'); ?>

<div id="gallery-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="single-image">
                    <img src="/assets/images/static/breast-1.jpg">
                    <div class="image-caption">
                        This is a sample caption
                    </div>
                </div>
                <div class="album">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators" id="album-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox" id="album-items">
                            <div class="item active">
                                <img src="/assets/images/static/breast-1.jpg">
                                <div class="carousel-caption">
                                    This is a sample caption
                                </div>
                            </div>
                            <div class="item">
                                <img src="/assets/images/static/breast-2.jpg">
                                <div class="carousel-caption">
                                    This is a sample caption
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/index.js"></script>