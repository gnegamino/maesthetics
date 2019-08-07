<?php

global $fileConfig;

$id = $_POST['id'];

$data = getData(sprintf(
        "SELECT `id`, `description`, CONCAT('%s', `path`) AS `path`  FROM `gallery` WHERE `id` = %s OR `parent_id` = %s",
        $fileConfig['storage_path'],
        $id,
        $id
    ));

if (count($data) < 1) {
    response(["message" => "Image not found."]);
    return;
}

response(["message" => "", "items" => $data]);