<?php

require 'config/database.php';
require 'config/file.php';
require 'config/email.php';

function response($data)
{
    echo json_encode($data);
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