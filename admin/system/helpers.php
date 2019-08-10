<?php

require 'system/constants.php';
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

    $connection = @mysqli_connect($host, $user, $password, $database);

    if (!$connection) {
        die(response(["message" => "Oh no! Something went wrong! Please contact the developers."]));
    }

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

function correctImageOrientation($filename)
{
    if (function_exists('exif_read_data')) {
        $exif = @exif_read_data($filename);
        if ($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if ($orientation != 1) {
                $img = imagecreatefromjpeg($filename);
                $deg = 0;
                switch ($orientation) {
                case 3:
                    $deg = 180;
                    break;
                case 6:
                    $deg = 270;
                    break;
                case 8:
                    $deg = 90;
                    break;
                }
                if ($deg) {
                    $img = imagerotate($img, $deg, 0);
                }
                imagejpeg($img, $filename, 95);
            }
        }
    }
}

function addGallery($files, $parentId, $module, $description = '')
{
    global $fileConfig;

    $validFiles = ['png', 'jpeg', 'jpg'];
    $filename = $files['file']['name'];

    if (strlen(trim($filename)) < 1) {
        return ["message" => "Invalid File."];
    }

    $parts = explode(".", $filename);
    $extension = strtolower($parts[count($parts) - 1]);

    if (!in_array($extension, $validFiles)) {
        return ["message" => "Invalid File."];
    }

    $newFilename = generateNewFileName().".".$extension;
    if (@move_uploaded_file($files['file']['tmp_name'], $fileConfig['storage_path'].$newFilename)) {
        correctImageOrientation($fileConfig['storage_path'].$newFilename);
        runQuery(sprintf(
            "INSERT INTO `gallery`(`path`, `parent_id`, `description`, `created_at`, `module`) VALUES ('%s', %s, '%s', NOW(), %s)",
            $newFilename,
            $parentId,
            $description,
            $module
        ));
        $data = getData(sprintf("SELECT `id` FROM `gallery` WHERE `path` = '%s'", $newFilename));
        return ["message" => "", "id" => $data[0]['id'], "path" => $fileConfig['storage_path'].$newFilename];
    }

    return ["message" => "File is too large."];
}