<?php

require 'config/database.php';

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
