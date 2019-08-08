<?php

$request = escapeString(['id' => $_POST['id'], 'name' => trim($_POST['name'])]);

if (strlen(trim($request['name'])) < 1) {
    response(["message" => "Please input Title."]);
    return;
}

$data = getData(sprintf(
    "SELECT `title` FROM `services_featured` WHERE `title` = '%s' AND `services_id` = %s",
    $request['name'],
    $request['id']
));
if (count($data) > 0) {
    response(["message" => "Title already exists!"]);
    return;
}

runQuery(sprintf(
    "INSERT INTO `services_featured` (`services_id`,`title`, `description`) VALUES (%s, '%s', '')", $request['id'], $request['name']
));
$data = getData(sprintf("SELECT `id` FROM `services_featured` WHERE `title` = '%s'", $request['name']));

response(["message" => "", "id" => $data[0]['id']]);