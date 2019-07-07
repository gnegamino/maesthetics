<?php

require 'core.php';

$password = $_POST['password'];

if ($password == '123') {
    response(["message" => ""]);
    $_SESSION["login"] = "true";
} else {
    response(["message" => "Invalid Password"]);
}
