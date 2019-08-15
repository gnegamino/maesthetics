<?php

global $fileConfig;

$request = escapeString(['id' => $_POST['id']]);

$data = getData(sprintf("SELECT * FROM `services_featured` WHERE `id` = %s", $request['id']));
if (!isset($data[0]['id'])) {
    response(["message" => "Item not found."]);
    return;
}

$title = $data[0]['title'];
$description = $data[0]['description'];

$data = getData(sprintf(
    "SELECT
        `id`,
        CONCAT('%s', `path`) AS `path`,
        IF (`module` = %s, 1, 0) AS `is_thumbnail`
    FROM `gallery` WHERE `parent_id` = %s AND `module` IN (%s, %s)",
    $fileConfig['storage_path'],
    SERVICE_FEATURED_THUMBNAIL,
    $request['id'],
    SERVICE_FEATURED,
    SERVICE_FEATURED_THUMBNAIL
));

$hasPhoto = 1;

if (count($data) < 1) {
    $data[0]['id'] = 0;
    $data[0]['path'] = '/assets/images/client-logo.png';
    $data[0]['is_thumbnail'] = 1;
    $hasPhoto = 0;
}

response(
    [
        "message" => "",
        "title" => $title,
        "description" => $description,
        "gallery" => $data,
        "has_photo" => $hasPhoto
    ]
);