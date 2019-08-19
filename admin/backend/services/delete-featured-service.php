<?php

$request = escapeString(['id' => $_POST['id']]);

global $fileConfig;

$data = getData(sprintf(
    "SELECT `id`, `path` FROM `gallery` WHERE `parent_id` = %s AND `module` IN(%s, %s)",
    $request['id'],
    SERVICE_FEATURED,
    SERVICE_FEATURED_THUMBNAIL
));

foreach ($data as $key => $value) {
    unlink($fileConfig['storage_path'].$value['path']);
}

runQuery(sprintf(
    "DELETE FROM `gallery` WHERE `parent_id` = %s AND `module` IN(%s, %s)",
    $request['id'],
    SERVICE_FEATURED,
    SERVICE_FEATURED_THUMBNAIL
));

runQuery(sprintf("DELETE FROM `services_featured` WHERE `id` = %s", $request['id']));

response(["message" => ""]);