<?php
    require_once('layouts/master_header.php');
    require_once('layouts/sub-navigation.php');
?>

<div class="container-fluid about">
    <div class="row">
        <div class="col-md-12 page-banner">
            <h1>OUR COMPANY</h1>
            <div class="motto">
                <h2>More Confident</h2>
                <h2>●</h2>
                <h2>More Beautiful</h2>
                <h2>●</h2>
                <h2>More You</h2>
            </div>
        </div>
        <div class="col-md-12 page-section">
            <div class="container">
                <div class="company-profile">
                    <div class="client-logo">
                        <img class="client-logo-img" src="/assets/images/client-logo.png">
                    </div>
                    <?php
                        $data = getData("SELECT `content` FROM `content` WHERE `module` = 'about' LIMIT 1");
                        if (isset($data[0]['content'])) {
                            echo $data[0]['content'];
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 owner-section">
            <div class="container">
                <div class="row doctor-mike clearfix">
                    <div class="col-md-3">
                        <img class="doctor-mike-image" src="/assets/images/mike-versoza.jpg">
                    </div>
                    <div class="col-md-9">
                        <div class="doctor-mike-details">
                            <h2>Dr. Michael "Mike" Verzosa, M.D., D.P.B.P.S</h2>
                            <h3>Board Certified Plastic Surgeon</h3>
                            <h3>Volunteer, Operation Smile</h3>
                            <h3>Volunteer, Smile Train</h3>
                            <div class="doctor-mike-affiliations">
                                <h3>Affiliations:</h3>
                                <h6>Philippine Association of Plastic Reconstructive and Aesthetic Surgeons (PAPRAS)</h6>
                                <img src="/assets/images/papras.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('layouts/master_footer.php'); ?>

<script src="/assets/js/index.js"></script>