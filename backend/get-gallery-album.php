<?php

global $fileConfig;

$id = $_POST['id'];
$data = getData(sprintf(
    "SELECT CONCAT('%s', `path`) AS `path`, `description` FROM `gallery` WHERE `id` = %s OR `parent_id` = %s",
    $fileConfig['storage_path'],
    $id,
    $id)
);

if (count($data) > 0) {
    response(["message" => "", "items" => $data]);
} else {
    response(["message" => "Item not found."]);
}