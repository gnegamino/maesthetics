<?php

$request = escapeString(['id' => $_POST['id'], 'name' => $_POST['name']]);

$parentId = $request['id'];
$name = trim($request['name']);

if (strlen($name) < 1) {
    response(["message" => "Name is cannot be empty."]);
    return;
}

$data = getData(sprintf(
    "SELECT `id` FROM `services_all` WHERE `parent_id` = %s AND `name` = '%s'",
    $parentId,
    $name
));

if (isset($data[0]['id'])) {
    response(["message" => "Name already exists."]);
    return;
}

$data = getData(sprintf("SELECT `services_id` FROM `services_all` WHERE `id` = %s", $parentId));
if (!isset($data[0]['services_id'])) {
    response(["message" => "Service not found."]);
    return;
}

$serviceId = $data[0]['services_id'];

runQuery(sprintf(
    "INSERT INTO `services_all` (`services_id`, `parent_id`, `name`) VALUES (%s, %s, '%s')",
    $serviceId,
    $parentId,
    $name
));

$data = getData(sprintf(
    "SELECT `id` FROM `services_all` WHERE `parent_id` = %s AND `name` = '%s'",
    $parentId,
    $name
));

if (!isset($data[0]['id'])) {
    response(["message" => "Unable to create data. Please contact the developers."]);
    return;
}

response(["message" => "", "id" => $data[0]['id']]);
