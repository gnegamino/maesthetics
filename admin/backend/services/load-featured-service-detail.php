<?php

$request = escapeString(['id' => $_POST['id']]);

$data = getData(sprintf("SELECT * FROM `services_featured` WHERE `id` = %s", $request['id']));
if (!isset($data[0]['id'])) {
    response(["message" => "Item not found."]);
    return;
}

response(
    [
        "message" => "",
        "title" => $data[0]['title'],
        "description" => $data[0]['description'],
    ]
);