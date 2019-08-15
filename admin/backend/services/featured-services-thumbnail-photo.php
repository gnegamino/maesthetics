<?php

global $fileConfig;

$request = escapeString(['id' => $_POST['id']]);

$data = getData(sprintf("SELECT `parent_id`, `path`, `module` FROM `gallery` WHERE `id` = %s", $request['id']));
if (!isset($data[0]['parent_id'])) {
    response(["message" => "Item not found."]);
    return;
}

runQuery(sprintf(
    "UPDATE `gallery` SET `module` = %s WHERE `parent_id` = %s AND `module` IN(%s, %s)",
    SERVICE_FEATURED,
    $data[0]['parent_id'],
    SERVICE_FEATURED,
    SERVICE_FEATURED_THUMBNAIL
));

runQuery(sprintf(
    "UPDATE `gallery` SET `module` = %s WHERE `id` = %s",
    SERVICE_FEATURED_THUMBNAIL,
    $request['id']
));

response(["message" => ""]);