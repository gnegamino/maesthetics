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

$command = "
    SELECT
        S.`id`,
        S.`title`, 
        IF(COALESCE(S.`description`, '') = '', '<i>No description has been set</i>', COALESCE(S.`description`, '')) AS `description`,
        COALESCE(G.`path`, '/assets/images/client-logo.png') AS `path`
    FROM `services_featured` AS S
    LEFT JOIN `gallery` AS G ON G.`parent_id` = S.`id` AND G.`module` = %s
    WHERE S.`services_id` = %s
    GROUP BY S.`id`";
$featured = getData(sprintf($command, SERVICE_FEATURED, $id));

response(["message" => "", "path" => $path, "featured_services" => $featured]);