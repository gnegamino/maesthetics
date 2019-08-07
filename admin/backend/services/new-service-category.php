<?php

if (strlen(trim($_POST['name'])) < 1) {
    response(["message" => "Name cannot be empty."]);
    return;
}

$content = escapeString(['name' => $_POST['name']]);
$data = getData(sprintf("SELECT COUNT(*) AS `count` FROM `services` WHERE `name` = '%s'", $content['name']));
if ($data[0]['count'] > 0) {
    response(["message" => "Name already exist!"]);
    return;
}

runQuery(sprintf("INSERT INTO `services` (`name`) VALUES ('%s')", $content['name']));
$data = getData(sprintf("SELECT `id`, `name` FROM `services` WHERE `name` = '%s' LIMIT 1", $content['name']));

response(["message" => "", "id" => $data[0]['id'], "name" => $data[0]['name']]);