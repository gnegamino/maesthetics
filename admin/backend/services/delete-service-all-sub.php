<?php

$request = escapeString(['id' => $_POST['id']]);

runQuery(sprintf("DELETE FROM `services_all` WHERE `id` = %s", $request['id']));

response(["message" => ""]);