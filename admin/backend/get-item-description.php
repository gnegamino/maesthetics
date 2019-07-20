<?php

$id = $_POST['id'];

$data = getData(sprintf("SELECT `description` FROM `gallery` WHERE `id` = %s LIMIT 1", $id));

if (count($data) < 1) {
    response(["message" => "Item not found."]);
    return;
}

response(["message" => "", "description" => $data[0]['description']]);