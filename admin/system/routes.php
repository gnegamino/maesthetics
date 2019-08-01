<?php

require 'router.php';

addRoute('login', 'views/login.php', false, false);
addRoute('gallery', 'views/gallery.php');
addRoute('about', 'views/about.php');
addRoute('services', 'views/services.php');
addRoute('change-password', 'views/change-password.php');
addRoute('logout', 'backend/logout.php', true, false);
addRoute('auth', 'backend/auth.php', true, false);
addRoute('auth-change-password', 'backend/auth-change-password.php', true, false);
addRoute('about-save-edit', 'backend/about-save-edit.php', true, false);
addRoute('create-album', 'backend/create-album.php', true, false);
addRoute('create-album-detail', 'backend/create-album-detail.php', true, false);
addRoute('view-album', 'backend/view-album.php', true, false);
addRoute('get-item-description', 'backend/get-item-description.php', true, false);
addRoute('save-item-description', 'backend/save-item-description.php', true, false);
addRoute('delete-item', 'backend/delete-item.php', true, false);
addRoute('delete-album', 'backend/delete-album.php', true, false);