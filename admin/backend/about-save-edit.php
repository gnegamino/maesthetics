<?php

$content = escapeString(['content' => $_POST['data']]);

runQuery("UPDATE `content` SET `content` = '".$content['content']."' WHERE `module` = 'about'");

response(["message" => ""]);
