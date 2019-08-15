<?php

global $fileConfig;

$request = escapeString(['id' => $_POST['id']]);

$data = getData(sprintf("SELECT `parent_id`, `path`, `module` FROM `gallery` WHERE `id` = %s", $request['id']));
if (!isset($data[0]['parent_id'])) {
    response(["message" => "Item not found."]);
    return;
}

$serviceId = $data[0]['parent_id'];

if ($data[0]['module'] == SERVICE_FEATURED_THUMBNAIL) {
    runQuery(sprintf("DELETE FROM `gallery` WHERE `id` = %s", $request['id']));
    unlink($fileConfig['storage_path'].$data[0]['path']);
    $data = getData(sprintf(
        "SELECT `id`, `path` FROM `gallery` WHERE `parent_id` = %s AND `module` = %s ORDER BY `created_at` LIMIT 1",
        $serviceId,
        SERVICE_FEATURED
    ));
    if (!isset($data[0]['id'])) {
        response([
            "message" => "",
            "thumbnail_id" => 0,
            "path" => "/assets/images/client-logo.png"
        ]);
    } else {
        runQuery(sprintf(
            "UPDATE `gallery` SET `module` = %s WHERE `id` = %s",
            SERVICE_FEATURED_THUMBNAIL,
            $data[0]['id']
        ));
        response([
            "message" => "",
            "thumbnail_id" => $data[0]['id'],
            "path" => $fileConfig['storage_path'].$data[0]['path']
        ]);
    }
} else {
    runQuery(sprintf("DELETE FROM `gallery` WHERE `id` = %s", $request['id']));
    unlink($fileConfig['storage_path'].$data[0]['path']);
    $data = getData(sprintf(
        "SELECT `id`, `path` FROM `gallery` WHERE `parent_id` = %s AND `module` = %s",
        $serviceId,
        SERVICE_FEATURED_THUMBNAIL
    ));

    if (!isset($data[0]['id'])) {
        response(["message" => "No thumbnail found"]);
        return;
    }

    response([
        "message" => "",
        "thumbnail_id" => $data[0]['id'],
        "path" => $fileConfig['storage_path'].$data[0]['path']
    ]);
}