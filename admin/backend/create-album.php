<?php

global $fileConfig;

$validFiles = ['png', 'jpeg', 'jpg'];
$filename = $_FILES['file']['name'];

if (strlen(trim($filename)) < 1) {
    response(["message" => "Invalid File."]);
    return;
}

$parts = explode(".", $filename);
$extension = strtolower($parts[count($parts) - 1]);

if (!in_array($extension, $validFiles)) {
    response(["message" => "Invalid File."]);
    return;
}

$newFilename = generateNewFileName().".".$extension;
if (@move_uploaded_file($_FILES['file']['tmp_name'], $fileConfig['storage_path'].$newFilename)) {
    runQuery(sprintf("INSERT INTO `gallery`(`path`, `description`, `created_at`) VALUES ('%s', '', NOW())", $newFilename));
    $data = getData(sprintf("SELECT `id` FROM `gallery` WHERE `path` = '%s'", $newFilename));
    response(["message" => "", "id" => $data[0]['id'], "path" =>  $fileConfig['storage_path'].$newFilename]);
    return;
}

response(["message" => "File is too large."]);