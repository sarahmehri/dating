<?php
/**
 * index.php
 * @author Sarah
 * @version 1.0
 */

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');
//session start
session_start();

$f3 = Base::instance();
$validator = new Validate();
$dataLayer = new DataLayer();
$controller = new Controller($f3);

$f3->set('DEBUG', 3);

//home page
$f3->route('GET /', function ()
{
    global $controller;
    $controller->home();
});

//personal route
$f3->route('GET|POST /personal', function ()
{
    global $controller;
    $controller->personal();
});

//profile info route
$f3->route('GET|POST /profile', function ()
{
    global $controller;
    $controller->profile();
});

//interest route
$f3->route('GET|POST /interest', function ()
{
    global $controller;
    $controller->interests();
});

//summary route
$f3->route('GET|POST /summary', function ()
{
    global $controller;
    $controller->summary();

});

//run fat free
$f3->run();