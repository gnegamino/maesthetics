<?php

global $fileConfig;

$id = $_POST['id'];
$parentId = 0;

$data = getData(sprintf("SELECT * FROM `gallery` WHERE `id` = %s", $id));
if (count($data) < 1) {
    response(["message" => "Item not found."]);
    return;
}

runQuery(sprintf("DELETE FROM `gallery` WHERE `id` = %s", $id));
unlink($fileConfig['storage_path'].$data[0]['path']);

$parentId = $data[0]['parent_id'];
$createdAt = $data[0]['created_at'];
$items = [];

if ($parentId == 0) {
    $children = getData(sprintf("SELECT * FROM `gallery` WHERE `parent_id` = %s", $id));
    if (count($children) > 0) {
        $newParentId = $children[0]['id'];
        $parentId = $newParentId;
        runQuery(sprintf("UPDATE `gallery` SET `parent_id` = 0, `created_at` = '%s' WHERE `id` = %s", $createdAt, $newParentId));
        runQuery(sprintf("UPDATE `gallery` SET `parent_id` = %s WHERE `parent_id` = %s", $newParentId, $id));
    } else {
        response(["message" => "", "items" => $items, 'reload' => true]);
        return;
    }
}

$items = getData(sprintf(
        "SELECT `id`, `description`, CONCAT('%s', `path`) AS `path`  FROM `gallery` WHERE `id` = %s OR `parent_id` = %s",
        $fileConfig['storage_path'],
        $parentId,
        $parentId
    ));

response(["message" => "", "items" => $items, 'reload' => count($items) < 1]);