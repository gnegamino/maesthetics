<?php

$id = $_POST['id'];
$description = $_POST['description'];

runQuery(sprintf("UPDATE `gallery` SET `description` = '%s' WHERE `id` = %s", $description, $id));

response(["message" => ""]);
