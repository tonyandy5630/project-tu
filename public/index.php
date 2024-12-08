<?php
require_once("config.php");
require_once "helper.php";
require_once("../database/dbhelper.php");
session_start();

$routes = require "routes.php";

$uri = $_SERVER['REQUEST_URI'];
$requestUri = strtok($uri, '?');

if (array_key_exists($requestUri, $routes)) {
    require(basePath(($routes[$requestUri])));
} else {
    require(basePath($routes['404']));
}
