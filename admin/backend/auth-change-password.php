<?php

$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$repeatPassword = $_POST['repeatPassword'];

if (!authUser($oldPassword)) {
    response(["message" => "Incorrect Password!"]);
    return;
}

$legnth = strlen(trim($newPassword));
if ($legnth > 20 || $legnth < 6) {
    response(["message" => "Password must be 6 to 20 characters only."]);
    return;
}

if ($newPassword != $repeatPassword) {
    response(["message" => "Password not matched!"]);
    return;
}

if ($oldPassword == $newPassword) {
    response(["message" => "New password must not be same as old/current password."]);
    return;
}

$data = escapeString(['password' => hashString($newPassword)]);
runQuery(sprintf("UPDATE `auth` SET `password` = '%s'", $data['password']));

response(["message" => ""]);
