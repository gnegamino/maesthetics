<?php
    require_once('layouts/master_header.php');
    require_once('layouts/sub-navigation.php');
?>

<div class="contact pushed-content">
    <div class="contact-form parallax parallax-1">
        <div class="container">
            <div class="contact-form-header">
                Get in touch with us
            </div>
        </div>
        <div class="contact-form-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-input--modified" placeholder="Name">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-input--modified" placeholder="Contact No.">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-input--modified" placeholder="E-mail Address">
                    </div>
                </div>
                <div class="row form-margin">
                    <div class="col-md-12">
                        <textarea class="form-control form-input--modified" rows="8" placeholder="Inquiries, Questions, Remarks"></textarea>
                    </div>
                </div>
                <div class="row form-margin">
                    <div class="col-md-12" align="center">
                        <button class="btn contact-submit" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-detail-location">
        <div class="container">
            <div class="flex">
                <div class="left">
                    <div class="location">
                        <h4>Location</h4>
                        <h2 class="emphasized">M Aesthetics Clinic</h2>
                        <h3>2nd Floor WDG Building</h3>
                        <h3>1470 Quezon Avenue Quezon City</h3>
                    </div>
                    <div class="contact-details">
                        <h4>Contact Information</h4>
                        <h3>(+632) 962 5744</h3>
                        <h3>(+639) 255 36 3651</h3>
                        <h3>
                            <img src="/assets/images/viber.png" class="viber-icon">
                            <img src="/assets/images/whatsapp.png" class="whatsapp-icon">
                            (0925) 536 3651
                        </h3>
                        <h3 class="emphasized">inquiry@m-aestheticsclinic.com</h3>
                    </div>
                </div>
                <div class="right">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.3656118342265!2d121.0209877147896!3d14.635175689780493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b64fb70082bd%3A0x33c05cd55df8f937!2sQuezon+Ave%2C+Quezon+City%2C+Metro+Manila!5e0!3m2!1sen!2sph!4v1560830148596!5m2!1sen!2sph"
                        width="100%"
                        height="600"
                        frameborder="0"
                        style="border:0"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('layouts/master_footer.php'); ?>

<script src="/assets/js/index.js"></script>