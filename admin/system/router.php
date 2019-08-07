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

function addRoutePage($url, $target, $validatePageSession = true)
{
    addRoute($url, $target, false, $validatePageSession);
}

function addRouteJson($url, $target)
{
    addRoute($url, $target, true, false);
}

function routeRequest()
{
    global $routes;

    if (isset($_GET['uri'])) {
        $request = $_GET['uri'];
        foreach ($routes as $key => $routeValue) {
            if ($request == $routeValue['url']) {
                if ($routeValue['validatePageSession']) {
                    validatePageSession($routeValue['url']);
                }
                if (!$routeValue['wantsJson']) {
                    viewHeader();
                }

                if (auth() && $routeValue['url'] == 'login') {
                    header("location: gallery");
                } else {
                    require $routeValue['target'];
                }

                if (!$routeValue['wantsJson']) {
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
