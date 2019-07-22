<?php

session_start();

require 'helpers.php';

$routes = [];

function route($url, $target)
{
    global $routes;

    $routes[] = [
        'url' => $url,
        'target' => $target,
    ];
}

function routeRequest()
{
    global $routes;

    if (isset($_GET['uri'])) {
        $request = $_GET['uri'];
        foreach ($routes as $key => $routeValue) {
            if ($request == $routeValue['url']) {
                require $routeValue['target'];
                return;
            }
        }
        require 'views/404.php';
    } else {
        require 'views/home.php';
    }
}