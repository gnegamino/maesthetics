<?php

global $fileConfig;

$id = $_POST['id'];
$data = getData(sprintf("SELECT `path`, `description` FROM `gallery` WHERE `id` = %s", $id));

if (count($data) > 0) {
    $data[0]['path'] = $fileConfig['storage_path'].$data[0]['path'];
    response(["message" => "", "item" => $data[0]]);
} else {
    response(["message" => "Item not found."]);
}