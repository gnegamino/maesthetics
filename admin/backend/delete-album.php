<?php

global $fileConfig;

$id = $_POST['id'];

$data = getData(sprintf("SELECT `parent_id` FROM `gallery` WHERE `id` = %s", $id));

if (count($data) < 1) {
    response(["message" => "Item not found."]);
    return;
}

$parentId = $data[0]['parent_id'];
$parentId = $parentId == 0 ? $id : $parentId;
$data = getData(sprintf("SELECT * FROM `gallery` WHERE `parent_id` = %s OR `id` = %s", $parentId, $id));
runQuery(sprintf("DELETE FROM `gallery` WHERE `parent_id` = %s OR `id` = %s", $parentId, $id));

foreach ($data as $key => $value) {
    unlink($fileConfig['storage_path'].$value['path']);
}

response(["message" => ""]);