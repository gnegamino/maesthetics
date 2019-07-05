<?php
    require_once('layouts/master_header.php');
    require_once('layouts/sub-navigation.php');
?>

<div class="services face-skin-body">
    <div class="page-banner">
        <h1>FACE, SKIN AND BODY</h1>
    </div>
    <div class="media-section">
        <div class="container">
            <h1>FEATURED SERVICES</h1>
            <div class="media-list">
                <div class="media-item" data-media-name="botox">
                    <div class="media-picture">
                        <img src="/assets/images/static/breast-1.JPG" alt="">
                    </div>
                    <div class="media-detail">
                        <div class="media-title">Botox</div>
                        <div class="media-description">
                            This is a facial cosmetic procedure that is usually performed to enhance the appearance of the nose. During this type of rhinoplasty, the nasal cartilage and bones are modified, or tissue is added.
                        </div>
                        <div class="media-button">
                            <button class="btn view-more">View More</button>
                        </div>
                    </div>
                </div>
                <div class="media-item" data-media-name="fillers">
                    <div class="media-picture">
                        <img src="/assets/images/static/breast-1.JPG" alt="">
                    </div>
                    <div class="media-detail">
                        <div class="media-title">Fillers</div>
                        <div class="media-description">
                            Also known as augmentation mammoplasty — is surgery to increase breast size. It involves placing breast implants under breast tissue or chest muscles.
                        </div>
                        <div class="media-button">
                            <button class="btn view-more">View More</button>
                        </div>
                    </div>
                </div>
                <div class="media-item" data-media-name="gluta drips">
                    <div class="media-picture">
                        <img src="/assets/images/static/breast-1.JPG" alt="">
                    </div>
                    <div class="media-detail">
                        <div class="media-title">Gluta Drips</div>
                        <div class="media-description">
                            A tummy tuck, also known as abdominoplasty, removes excess fat and skin and restores weakened muscles to create a smoother, firmer abdominal profile.
                        </div>
                        <div class="media-button">
                            <button class="btn view-more">View More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="all-services-section">
        <div class="container">
            <h1>ALL FACE, SKIN AND BODY SERVICES</h1>
            <div class="media-box">
                <div class="media-box-item">
                    <div class="media-box-header">
                        <div class="media-box-header-icon"><i class="fa fa-plus"></i></div>
                        <div class="media-box-header-title">OTHERS</div>
                    </div>
                    <div class="media-box-content">
                        <div class="flex">
                            <ul>
                                <li><a href="contact.php">Facial</a></li>
                                <li><a href="contact.php">Whitening</a></li>
                                <li><a href="contact.php">Peeling</a></li>
                                <li><a href="contact.php">Anti Aging</a></li>
                                <li><a href="contact.php">V-lift / Thread Lift</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('layouts/master_footer.php'); ?>

<div id="preview-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="media-preview active" data-media-name="botox">
                    <div class="media-write-up">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime exercitationem saepe fugit sed nihil tenetur quis minus quae odit reiciendis dignissimos voluptas dolore, itaque totam fuga reprehenderit, iure aspernatur error.</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime exercitationem saepe fugit sed nihil tenetur quis minus quae odit reiciendis dignissimos voluptas dolore, itaque totam fuga reprehenderit, iure aspernatur error.</p>
                    </div>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="/assets/images/static/breast-1.JPG">
                            </div>
                            <div class="item">
                                <img src="/assets/images/static/breast-2.JPG">
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
                <div class="media-preview" data-media-name="fillers">
                    <div class="media-write-up">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime exercitationem saepe fugit sed nihil tenetur quis minus quae odit reiciendis dignissimos voluptas dolore, itaque totam fuga reprehenderit, iure aspernatur error.</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime exercitationem saepe fugit sed nihil tenetur quis minus quae odit reiciendis dignissimos voluptas dolore, itaque totam fuga reprehenderit, iure aspernatur error.</p>
                    </div>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="/assets/images/static/breast-1.JPG">
                            </div>
                            <div class="item">
                                <img src="/assets/images/static/breast-2.JPG">
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
                <div class="media-preview" data-media-name="gluta drips">
                    <div class="media-write-up">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime exercitationem saepe fugit sed nihil tenetur quis minus quae odit reiciendis dignissimos voluptas dolore, itaque totam fuga reprehenderit, iure aspernatur error.</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime exercitationem saepe fugit sed nihil tenetur quis minus quae odit reiciendis dignissimos voluptas dolore, itaque totam fuga reprehenderit, iure aspernatur error.</p>
                    </div>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="/assets/images/static/breast-1.JPG">
                            </div>
                            <div class="item">
                                <img src="/assets/images/static/breast-2.JPG">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Inquire Now!</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/index.js"></script>