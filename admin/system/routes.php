<?php

require 'router.php';

addRoute('login', 'views/login.php', false, false);
addRoute('change-password', 'views/change-password.php');
addRoute('logout', 'backend/auth/logout.php', true, false);
addRoute('auth', 'backend/auth/auth.php', true, false);
addRoute('auth-change-password', 'backend/auth/auth-change-password.php', true, false);

addRoute('gallery', 'views/gallery.php');
addRoute('create-album', 'backend/gallery/create-album.php', true, false);
addRoute('create-album-detail', 'backend/gallery/create-album-detail.php', true, false);
addRoute('view-album', 'backend/gallery/view-album.php', true, false);
addRoute('get-item-description', 'backend/gallery/get-item-description.php', true, false);
addRoute('save-item-description', 'backend/gallery/save-item-description.php', true, false);
addRoute('delete-item', 'backend/gallery/delete-item.php', true, false);
addRoute('delete-album', 'backend/gallery/delete-album.php', true, false);

addRoute('about', 'views/about.php');
addRoute('about-save-edit', 'backend/about/about-save-edit.php', true, false);

addRoute('services', 'views/services.php');
addRoute('new-service-category', 'backend/services/new-service-category.php', true, false);
addRoute('set-service-name', 'backend/services/set-service-name.php', true, false);
addRoute('delete-service', 'backend/services/delete-service.php', true, false);
addRoute('change-service-default-background', 'backend/services/change-service-default-background.php', true, false);
addRoute('get-service-default-background', 'backend/services/get-service-default-background.php', true, false);
addRoute('change-service-background', 'backend/services/change-service-background.php', true, false);
addRoute('reset-service-background', 'backend/services/reset-service-background.php', true, false);