<?php

$password = $_POST['password'];

if (authUser($password)) {
    response(["message" => ""]);
    $_SESSION["login"] = "true";
} else {
    response(["message" => "Invalid Password"]);
}
