<?php

require 'config/database.php';
require 'config/file.php';

function response($data)
{
    echo json_encode($data);
}

function auth()
{
    return isset($_SESSION['login']);
}

function hashString($string)
{
    return password_hash($string, PASSWORD_DEFAULT);
}

function verifyHash($string, $hashed)
{
    return password_verify($string, $hashed);
}

function dbConnect()
{
    global $dbConfig;
    $host = $dbConfig['host'];
    $user = $dbConfig['user'];
    $password = $dbConfig['password'];
    $database = $dbConfig['database'];

    $connection = mysqli_connect($host, $user, $password, $database) or die("Database connection Error.");

    return $connection;
}

function getData($sql)
{
    $connection = dbConnect();
    $result = mysqli_query($connection, $sql);
    $resultSet = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($connection);

    return $resultSet;
}

function runQuery($sql)
{
    $connection = dbConnect();
    mysqli_query($connection, $sql);
    mysqli_close($connection);
}

function escapeString($data)
{
    $escaped = [];

    $connection = dbConnect();
    foreach ($data as $key => $value) {
        $escaped[$key] = mysqli_real_escape_string($connection, $value);
    }
    mysqli_close($connection);

    return $escaped;
}

function authUser($password)
{
    $data = getData("SELECT `password` FROM `auth` LIMIT 1");

    return verifyHash($password, $data[0]['password']);
}

function generateNewFileName($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString.'_'.time();
}

function photoCountLabel($count)
{
    if ($count > 1) {
        return $count." Photos";
    }

    return $count." Photo";
}