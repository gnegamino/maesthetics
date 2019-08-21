<?php

$request = escapeString(['id' => $_POST['id'], 'name' => $_POST['name']]);

$id = $request['id'];
$name = trim($request['name']);

if (strlen($name) < 1) {
    response(["message" => "Name is cannot be empty."]);
    return;
}

$data = getData(sprintf("SELECT `services_id`, `parent_id` FROM `services_all` WHERE `id` = %s", $id));

if (!isset($data[0]['parent_id'])) {
    response(["message" => "Item not found or deleted."]);
    return;
}

$parentId = $data[0]['parent_id'];
$servicesId = $data[0]['services_id'];

if ($parentId == 0) {
    $data = getData(sprintf(
        "SELECT `id` FROM `services_all` WHERE `parent_id` = 0 AND `id` <> %s AND `services_id` = %s AND `name` = '%s'",
        $id,
        $servicesId,
        $name
    ));

    if (isset($data[0]['id'])) {
        response(["message" => "Name already exists."]);
        return;
    }
} else {
    $data = getData(sprintf(
        "SELECT `id` FROM `services_all` WHERE `parent_id` = %s AND `id` <> %s AND `name` = '%s'",
        $parentId,
        $id,
        $name
    ));

    if (isset($data[0]['id'])) {
        response(["message" => "Name already exists."]);
        return;
    }
}

runQuery(sprintf("UPDATE `services_all` SET `name` = '%s' WHERE `id` = %s", $name, $id));

response(["message" => ""]);