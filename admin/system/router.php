<?php

session_start();

require 'helpers.php';

$routes = [];

function addRoute($url, $target, $wantsJson = false, $validatePageSession = true)
{
    global $routes;

    $routes[] = [
        'url' => $url,
        'target' => $target,
        'wantsJson' => $wantsJson,
        'validatePageSession' => $validatePageSession
    ];
}

function routeRequest()
{
    global $routes;

    if (isset($_GET['uri'])) {
        $request = $_GET['uri'];
        foreach ($routes as $key => $value) {
            if ($request == $value['url']) {
                if ($value['validatePageSession']) {
                    validatePageSession($value['url']);
                }
                if (!$value['wantsJson']) {
                    viewHeader();
                }

                if (auth() && $value['url'] == 'login') {
                    header("location: gallery");
                } else {
                    require $value['target'];
                }

                if (!$value['wantsJson']) {
                    viewFooter();
                }
                return;
            }
        }
        viewHeader();
        require 'views/404.php';
        viewFooter();
    } else {
        if (auth()) {
            header("location: gallery");
        } else {
            viewHeader();
            require 'views/login.php';
            viewFooter();
        }
    }
}

function viewHeader()
{
    require 'views/master/header.php';
}

function viewFooter()
{
    require 'views/master/footer.php';
}

function validatePageSession($url)
{
    if ($url == 'login') {
        if (auth()) {
            header("location: gallery");
        }
    } else {
        if (!auth()) {
            header("location: login");
        }
    }
}
