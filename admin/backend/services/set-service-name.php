<?php

if (strlen(trim($_POST['name'])) < 1) {
    response(["message" => "Name cannot be empty."]);
    return;
}

$content = escapeString(['id' => $_POST['id'],'name' => $_POST['name']]);
$data = getData(sprintf(
    "SELECT COUNT(*) AS `count` FROM `services` WHERE `id` <> %s AND `name` = '%s'", $content['id'], $content['name']
));
if ($data[0]['count'] > 0) {
    response(["message" => "Name already exist!"]);
    return;
}

runQuery(sprintf("UPDATE `services` SET `name` = '%s' WHERE `id` = %s", $content['name'], $content['id']));
response(["message" => ""]);