<?php

$request = escapeString(['id' => $_POST['id'], 'name' => $_POST['name']]);

$serviceId = $request['id'];
$name = trim($request['name']);

if (strlen($name) < 1) {
    response(["message" => "Name is cannot be empty."]);
    return;
}

$data = getData(sprintf(
    "SELECT `id` FROM `services_all` WHERE `services_id` = %s AND `name` = '%s'",
    $serviceId,
    $name
));

if (isset($data[0]['id'])) {
    response(["message" => "Name already exists."]);
    return;
}

runQuery(sprintf(
    "INSERT INTO `services_all` (`services_id`, `parent_id`, `name`) VALUES (%s, 0, '%s')",
    $serviceId,
    $name
));

$data = getData(sprintf(
    "SELECT `id` FROM `services_all` WHERE `services_id` = %s AND `name` = '%s'",
    $serviceId,
    $name
));

if (!isset($data[0]['id'])) {
    response(["message" => "Unable to create data. Please contact the developers."]);
    return;
}

response(["message" => "", "id" => $data[0]['id']]);