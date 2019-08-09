<?php

$request = escapeString([
    'id' => $_POST['id'],
    'service-id' => $_POST['service'],
    'title' => trim($_POST['title']),
    'description' => trim($_POST['description'])
]);

if (strlen($request['title']) < 1) {
    response(["message" => "Please input title."]);
    return;
}

$data = getData(sprintf(
    "SELECT `title` FROM `services_featured` WHERE `title` = '%s' AND `services_id` = %s AND `id` <> %s",
    $request['title'],
    $request['service-id'],
    $request['id']
));
if (count($data) > 0) {
    response(["message" => "Title already exists!"]);
    return;
}

runQuery(sprintf(
    "UPDATE `services_featured` SET `title` = '%s', `description` = '%s' WHERE `id` = %s",
    $request['title'],
    $request['description'],
    $request['id']
));

response(["message" => ""]);