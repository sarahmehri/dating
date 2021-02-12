<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');

$f3 = Base::instance();
$f3->set('DEBUG', 3);
//home route
$f3->route('GET /', function ($f3) {
    $view = new Template();
    echo $view->render('views/home.html');
});

//personal info Route
$f3->route('GET /personal', function () {
    $view = new Template();
    echo $view->render('views/personal_info.html');
});

//profile Route
$f3->route('POST /profile', function ($f3) {
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(isset($_POST['fname']))
        {
            $_SESSION['fname'] = $_POST['fname'];
        }

        if(isset($_POST['lname']))
        {
            $_SESSION['lname'] = $_POST['lname'];
        }

        if(isset($_POST['age']))
        {
            $_SESSION['age'] = $_POST['age'];
        }
        if(isset($_POST['phone']))
        {
            $_SESSION['phone'] = $_POST['phone'];
        }
        if(isset($_POST['gender']))
        {
            foreach($_POST['gender'] as $gender)
            {
                $_SESSION['gender'] = $gender;
            }
        }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

//interest Route
$f3->route('POST /interest', function ($f3) {

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(isset($_POST['email']))
        {
            $_SESSION['email'] = $_POST['email'];
        }
        if(isset($_POST['states']))
        {
            $_SESSION['state'] = $_POST['states'];
        }
        if(isset($_POST['seeking']))
        {
            foreach($_POST['seeking'] as $gender)
            {
                $_SESSION['seeking'] = $gender;
            }
        }

        if(isset($_POST['bio']))
        {
            $_SESSION['bio'] = $_POST['bio'];
        }
    }

    $view = new Template();
    echo $view->render('views/interest.html');
});

//summary route
$f3->route('POST /summary', function ($f3) {
    $f3->set('title', 'Your Profile');
    $f3->set('name', $_SESSION['fname']." ".$_SESSION['lname']);
    $f3->set('gender', $_SESSION['gender']);
    $f3->set('age', $_SESSION['age']);
    $f3->set('phone', $_SESSION['phone']);
    $f3->set('email', $_SESSION['email']);
    $f3->set('state', $_SESSION['state']);
    $f3->set('seeking', $_SESSION['seeking']);
    $f3->set('interests', $_POST['interests']);
    $f3->set('bio', $_SESSION['bio']);
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Rune fat free
$f3->run();