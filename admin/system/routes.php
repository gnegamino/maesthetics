<?php

require 'router.php';

addRoute('login', 'views/login.php', false, false);
addRoute('', 'views/gallery.php');
addRoute('gallery', 'views/gallery.php');
addRoute('about', 'views/about.php');
addRoute('change-password', 'views/change-password.php');
addRoute('logout', 'backend/logout.php', true, false);
addRoute('auth', 'backend/auth.php', true, false);
