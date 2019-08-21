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
        IF(
            COALESCE(S.`description`, '') = '',
            '<i>No description has been set</i>',
            COALESCE(S.`description`, '')
        ) AS `description`,
        IF (
            COALESCE(G.`path`, '') = '',
            '/assets/images/client-logo.png',
            CONCAT('%s', G.`path`)
        ) AS `path`
    FROM `services_featured` AS S
    LEFT JOIN `gallery` AS G ON G.`parent_id` = S.`id` AND G.`module` = %s
    WHERE S.`services_id` = %s";

$featured = getData(sprintf($command, $fileConfig['storage_path'], SERVICE_FEATURED_THUMBNAIL, $id));


$command = "
    SELECT
        P.`services_id`,
        C.`id`,
        P.`id` AS `parent_id`,
        C.`name`
    FROM `services_all` AS P
    LEFT JOIN `services_all` AS C ON (C.`parent_id` = P.`id` OR C.`id` = P.`id`) AND C.`services_id` = %s
    WHERE P.`parent_id` = 0 AND P.`services_id` = %s";

$all = getData(sprintf($command, $id, $id));

response(["message" => "", "path" => $path, "featured_services" => $featured, "all_services" => $all]);