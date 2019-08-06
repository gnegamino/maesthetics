<?php

$id = $_POST['id'];
runQuery(sprintf("DELETE FROM `services` WHERE `id` = %s", $id));

response(["message" => ""]);