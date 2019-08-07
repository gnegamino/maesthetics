<?php
global $fileConfig;

$content = escapeString(['id' => $_POST['id']]);
$id = $content['id'];

$data = getData(sprintf("SELECT `path` FROM `gallery` WHERE `module` = %s AND `parent_id` = %s", SERVICE_BACKGROUND, $id));
if (isset($data[0]['path'])) {
    unlink($fileConfig['storage_path'].$data[0]['path']);
    runQuery(sprintf("DELETE FROM `gallery` WHERE `module` = %s AND `parent_id` = %s", SERVICE_BACKGROUND, $id));
}

response(addGallery($_FILES, $id, SERVICE_BACKGROUND));