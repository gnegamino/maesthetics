<?php

$request = escapeString(['id' => $_POST['id']]);

$data = getData(sprintf("SELECT `id` FROM `services_featured` WHERE `id` = %s", $request['id']));
if (!isset($data[0]['id'])) {
    response(["message" => "Featured service not found."]);
}

$module = SERVICE_FEATURED;
$data = getData(sprintf(
    "SELECT `id` FROM `gallery` WHERE `parent_id` = %s AND `module` = %s",
    $request['id'],
    SERVICE_FEATURED_THUMBNAIL
));

if (!isset($data[0]['id'])) {
    $module = SERVICE_FEATURED_THUMBNAIL;
}

response(addGallery($_FILES, $request['id'], $module));