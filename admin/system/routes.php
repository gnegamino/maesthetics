<?php

require 'router.php';

addRoutePage('login', 'views/login.php', false);
addRoutePage('change-password', 'views/change-password.php');
addRouteJson('logout', 'backend/auth/logout.php');
addRouteJson('auth', 'backend/auth/auth.php');
addRouteJson('auth-change-password', 'backend/auth/auth-change-password.php');

addRoutePage('gallery', 'views/gallery.php');
addRouteJson('create-album', 'backend/gallery/create-album.php');
addRouteJson('create-album-detail', 'backend/gallery/create-album-detail.php');
addRouteJson('view-album', 'backend/gallery/view-album.php');
addRouteJson('get-item-description', 'backend/gallery/get-item-description.php');
addRouteJson('save-item-description', 'backend/gallery/save-item-description.php');
addRouteJson('delete-item', 'backend/gallery/delete-item.php');
addRouteJson('delete-album', 'backend/gallery/delete-album.php');

addRoutePage('about', 'views/about.php');
addRouteJson('about-save-edit', 'backend/about/about-save-edit.php');

addRoutePage('services', 'views/services.php');
addRouteJson('new-service-category', 'backend/services/new-service-category.php');
addRouteJson('set-service-name', 'backend/services/set-service-name.php');
addRouteJson('delete-service', 'backend/services/delete-service.php');
addRouteJson('change-service-default-background', 'backend/services/change-service-default-background.php');
addRouteJson('get-service-default-background', 'backend/services/get-service-default-background.php');
addRouteJson('change-service-background', 'backend/services/change-service-background.php');
addRouteJson('reset-service-background', 'backend/services/reset-service-background.php');
addRouteJson('select-service', 'backend/services/select-service.php');
addRouteJson('new-featured-service', 'backend/services/new-featured-service.php');
addRouteJson('load-featured-service-detail', 'backend/services/load-featured-service-detail.php');
addRouteJson('save-featured-service-detail', 'backend/services/save-featured-service-detail.php');
addRouteJson('featured-services-add-photo', 'backend/services/featured-services-add-photo.php');
addRouteJson('featured-services-delete-photo', 'backend/services/featured-services-delete-photo.php');
addRouteJson('featured-services-thumbnail-photo', 'backend/services/featured-services-thumbnail-photo.php');
addRouteJson('delete-featured-service', 'backend/services/delete-featured-service.php');
addRouteJson('add-new-service-all', 'backend/services/add-new-service-all.php');
addRouteJson('add-new-sub-service-all', 'backend/services/add-new-sub-service-all.php');