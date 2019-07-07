<?php

session_start();

if (isset($_GET['uri'])) {
    $request = $_GET['uri'];
    switch ($request) {
        case 'login':
            checkAuth();
            viewHeader();
            require 'views/login.php';
            viewFooter();
            break;
        case 'about':
            checkSession();
            viewHeader();
            require 'views/about.php';
            viewFooter();
            break;
        case 'gallery':
            checkSession();
            viewHeader();
            require 'views/gallery.php';
            viewFooter();
            break;
        case 'change-password':
            checkSession();
            viewHeader();
            require 'views/change-password.php';
            viewFooter();
            break;
        case 'logout':
            require 'backend/logout.php';
            break;
        case 'auth':
            require 'backend/auth.php';
            break;
        default:
            viewHeader();
            require 'views/404.php';
            viewFooter();
            break;
    }
} else {
    checkAuth();
    viewHeader();
    require 'views/login.php';
    viewFooter();
}

function viewHeader()
{
    require 'views/master/header.php';
}

function viewFooter()
{
    require 'views/master/footer.php';
}

function checkAuth()
{
    if (isset($_SESSION['login'])) {
        header("location: home");
    }
}

function checkSession()
{
    if (!isset($_SESSION['login'])) {
        header("location: login");
    }
}
