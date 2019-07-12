<?php

require 'core.php';

$password = $_POST['password'];

if (authUser($password)) {
    response(["message" => ""]);
    $_SESSION["login"] = "true";
} else {
    response(["message" => "Invalid Password"]);
}

function authUser($password)
{
    $data = getData("SELECT `password` FROM `auth` LIMIT 1");

    return verifyHash($password, $data[0]['password']);
}
