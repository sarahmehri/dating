<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/valid.php');

$f3 = Base::instance();
$f3->set('DEBUG', 3);
//home route
$f3->route('GET /', function ($f3) {
    $view = new Template();
    echo $view->render('views/home.html');
});

//personal info Route
$f3->route('GET|POST /personal', function ($f3) {
    $f3->set('genders', getGenders());
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $f3->set('fname', $_POST['fname']);
        if(validName($_POST['fname']))
        {
            $_SESSION['fname'] = $_POST['fname'];
        }
        else{

            $f3->set("errors['fname']", 'Please enter a name');
        }
        $f3->set('lname', $_POST['lname']);
        if(validName($_POST['lname']))
        {
            $_SESSION['lname'] = $_POST['lname'];
        }
        else{
            $f3->set("errors['lname']", 'Please enter a valid last name');
        }
        $f3->set('age', $_POST['age']);
        if(validAge($_POST['age']))
        {
            $_SESSION['age'] = $_POST['age'];
        }
        else{
            $f3->set("errors['age']", 'Please enter a valid age (between 18 - 118)');
        }
        $f3->set('phone', $_POST['phone']);
        if(validPhone($_POST['phone']))
        {
            $_SESSION['phone'] = $_POST['phone'];
        }
        else{
            $f3->set("errors['phone']", 'Please enter a valid phone number');
        }
        $f3->set('userGender', $_POST['userGender']);
        if($_POST['userGender'] != null && validGender($_POST['userGender'])) {
            $_SESSION['userGender'] = $_POST['userGender'];
        }
        else {
            $_SESSION['userGender'] = "N/A";
        }

        if(empty($f3->get('errors'))) {
            $f3->reroute('profile');
        }
    }

    $view = new Template();
    echo $view->render('views/personal_info.html');
});

//profile Route
$f3->route('GET|POST /profile', function ($f3) {
    $f3->set('states',getStates());
    $f3->set('genders', getGenders());
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $f3->set('email', $_POST['email']);
        if(validEmail($_POST['email'])) {
            $_SESSION['email'] = $_POST['email'];
        }
        else{
            $f3->set("errors['email']", 'Please enter a valid email address');
        }

        $f3->set('userState', $_POST['states']);
        if(validState($_POST['states'])) {
            $_SESSION['state'] = $_POST['states'];
        }
        else{
            $_SESSION['states'] = "N/A";
        }
        $f3->set('seeking', $_POST['seeking']);
        if($_POST['seeking'] != null && validGender($_POST['seeking'])) {
            $_SESSION['seeking'] = $_POST['seeking'];
        }
        else{
            $_SESSION['seeking'] = "N/A";
        }

        $f3->set('bio', $_POST['bio']);
        if(!empty($_POST['bio'])) {
            $_SESSION['bio'] = $_POST['bio'];
        }
        else{
            $_SESSION['bio'] = "N/A";
        }
        if(empty($f3->get('errors'))) {
            $f3->reroute('interest');
        }
    }


    $view = new Template();
    echo $view->render('views/profile.html');
});

//interest Route
$f3->route('GET|POST /interest', function ($f3) {
    $f3->set('indoor', getIndoor());
    $f3->set('outdoor', getOutdoor());


    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['indoorInterests']) && validIndoor($_POST['indoorInterests'])){
            $_SESSION['indoorInterests'] = $_POST['indoorInterests'];
        }
        else{

            $_SESSION['indoorInterests'] = (array) null;
        }

        if(isset($_POST['outdoorInterests']) && validOutdoor($_POST['outdoorInterests'])){
            $_SESSION['outdoorInterests'] = $_POST['outdoorInterests'];
        }
        else {

            $_SESSION['outdoorInterests'] = (array) null;
        }

        if(!empty($_SESSION['outdoorInterests'] || $_SESSION['indoorInterests'])) {
            $_SESSION['indoorAndOutdoor'] =
            implode(", ", array_merge($_SESSION['indoorInterests'],$_SESSION['outdoorInterests']));
        }

        else{
            $_SESSION['indoorAndOutdoor'] ="N/A";
        }

        //Reroute to summary
        $f3->reroute('summary');
    }


    $view = new Template();
    echo $view->render('views/interest.html');
});

//summary route
$f3->route('GET|POST /summary', function () {
    //var_dump($_SESSION);
    $view = new Template();
    echo $view->render('views/summary.html');
    //session_destroy();
});

//Rune fat free
$f3->run();