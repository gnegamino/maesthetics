<?php

$request = escapeString(['id' => $_POST['id']]);

runQuery(sprintf("DELETE FROM `services_all` WHERE `id` = %s", $request['id']));
runQuery(sprintf("DELETE FROM `services_all` WHERE `parent_id` = %s", $request['id']));

response(["message" => ""]);