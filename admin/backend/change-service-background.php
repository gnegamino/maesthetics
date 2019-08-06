<?php
global $fileConfig;
$data = getData(sprintf("SELECT `path` FROM `gallery` WHERE `module` = %s", SERVICE_BACKGROUND));
if (isset($data[0]['path'])) {
    unlink($fileConfig['storage_path'].$data[0]['path']);
    runQuery(sprintf("DELETE FROM `gallery` WHERE `module` = %s", SERVICE_BACKGROUND));
}

response(addGallery($_FILES, 0, SERVICE_BACKGROUND));