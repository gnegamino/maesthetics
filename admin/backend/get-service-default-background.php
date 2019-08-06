<?php

global $fileConfig;
$data = getData(sprintf("SELECT `path` FROM `gallery` WHERE `module` = %s", SERVICE_DEFAULT_BACKGROUND));
if (isset($data[0]['path'])) {
    $path = $fileConfig['storage_path'].$data[0]['path'];
    response(["message" => "", "path" => $path]);
    return;
}

response(["message" => "No background set"]);
