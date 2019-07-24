<?php

require 'router.php';

route('home', 'views/home.php');
route('about', 'views/about.php');
route('contact', 'views/contact.php');
route('gallery', 'views/gallery.php');
route('services', 'views/services.php');
route('surgeries', 'views/surgeries.php');
route('face-skin-body', 'views/face-skin-body.php');
route('lasers-machines', 'views/lasers-machines.php');
route('get-gallery-item', 'backend/get-gallery-item.php');
route('get-gallery-album', 'backend/get-gallery-album.php');