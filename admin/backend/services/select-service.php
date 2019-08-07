<?php

global $fileConfig;

$content = escapeString(['id' => $_POST['id']]);
$id = $content['id'];

$data = getData(sprintf("SELECT `path` FROM `gallery` WHERE `module` = %s AND `parent_id` = %s", SERVICE_BACKGROUND, $id));
$path = "";
if (isset($data[0]['path'])) {
    $path = $fileConfig['storage_path'].$data[0]['path'];
} else {
    $data = getData(sprintf("SELECT `path` FROM `gallery` WHERE `module` = %s", SERVICE_DEFAULT_BACKGROUND));
    if (isset($data[0]['path'])) {
        $path = $fileConfig['storage_path'].$data[0]['path'];
    }
}

response(["message" => "", "path" => $path]);