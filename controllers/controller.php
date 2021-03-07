<?php

/**
 * Class Controller
 * @author Sarah
 * @version 1.0
 */
class Controller
{
    private $_f3;

    /**
     * Controller constructor.
     * @param $f3 object
     */
    public function __construct($f3)
    {
        global $dataLayer;
        $this->_f3 = $f3;
        $this->_f3->set('genders', $dataLayer->getGenders());
        $this->_f3->set('states', $dataLayer->getStates());
        $this->_f3->set('indoorInterests', $dataLayer->getIndoor());
        $this->_f3->set('outdoorInterests', $dataLayer->getOutdoor());

    }

    /**
     * home page
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }
    /**
     * personal page
     */

    function personal()
    {
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $age = $_POST['age'];
            if($validator->validName($_POST['fName'])){
                $_SESSION['fName'] = $_POST['fName'];
            }
            else{
                $this->_f3->set("errors['fName']", 'please enter a valid first name');
            }

            if($validator->validName($_POST['lName'])){
                $_SESSION['lName'] = $_POST['lName'];
            }
            else{
                $this->_f3->set("errors['lName']", 'please enter a valid last name');
            }

            if($validator->validAge($_POST['age'])){
                $_SESSION['age'] = $_POST['age'];
            }
            else{
                $this->_f3->set("errors['age']", 'please enter a valid age above 18');
            }

            if($validator->validPhone($_POST['phone'])){
                $_SESSION['phone'] = $_POST['phone'];
            }
            else{
                $this->_f3->set("errors['phone']", 'please entervalid phone number');
            }

            if($validator->validGender($_POST['userGender'])){
                $_SESSION['userGender'] = $_POST['userGender'];
            }
            else{
                $_SESSION['userGender'] = "N/A";
            }

            $_SESSION['premium'] = isset($_POST['premium']);

            if(empty($this->_f3->get('errors'))){
                //if the errors are empty, if the premium check,
                // add these to member of premium object
                if($_SESSION['premium']){
                    $member = new PremiumMember($_SESSION['fName'], $_SESSION['lName'], $_SESSION['userGender'],
                        $_SESSION['age'], $_SESSION['phone']);
                }
                else{
                    $member = new Member($_SESSION['fName'], $_SESSION['lName'], $_SESSION['userGender'],
                        $_SESSION['age'], $_SESSION['phone']);
                }

                $_SESSION['member'] = $member;
                $this->_f3->reroute('profile');
            }
        }
        //set everything for sticky form
        $this->_f3->set('fName', isset($_POST['fName']) ? $_POST['fName'] : "");
        $this->_f3->set('lName', isset($_POST['lName']) ? $_POST['lName'] : "");
        $this->_f3->set('age', isset($_POST['age']) ? $_POST['age'] : "");
        $this->_f3->set('userGender', isset($_POST['userGender']) ? $_POST['userGender'] : "");
        $this->_f3->set('phone', isset($_POST['phone']) ? $_POST['phone'] : "");
        $this->_f3->set('premium', isset($_POST['premium']) ? "checked": "");

        $view = new Template();
        echo $view->render('views/personal.html');
    }
    /**
     * profile
     */
    function profile()
    {
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if($validator->validEmail($_POST['email'])){
                $_SESSION['email'] = $_POST['email'];
            }
            else{
                $this->_f3->set("errors['email']", 'please enter a Valid email address');
            }

            if($validator->validState($_POST['states'])){
                $_SESSION['states'] = $_POST['states'];
            }
            else{
                $_SESSION['states'] = "N/A";
            }

            if($validator->validGender($_POST['seekingGender'])){
                $_SESSION['seekingGender'] = $_POST['seekingGender'];
            }
            else{
                $_SESSION['seekingGender'] = "N/A";
            }

            if(!empty($_POST['bio'])){
                $_SESSION['bio'] = $_POST['bio'];
            }
            else{
                $_SESSION['bio'] = "N/A";
            }

            if(empty($this->_f3->get('errors'))){

                //if empty erros put set everything to member session or object
                $_SESSION['member']->setEmail($_SESSION['email']);
                $_SESSION['member']->setState($_SESSION['states']);
                $_SESSION['member']->setSeeking($_SESSION['seekingGender']);
                $_SESSION['member']->setBio($_SESSION['bio']);

                $this->_f3->reroute('interest');
            }
        }
        // sticky forms
        $this->_f3->set('email', isset($_POST['email']) ? $_POST['email'] : "");
        $this->_f3->set('userState', $_POST['states']);
        $this->_f3->set('seekingGender', isset($_POST['seekingGender']) ? $_POST['seekingGender'] : "");
        $this->_f3->set('bio', isset($_POST['bio']) ? $_POST['bio'] : "");

        $view = new Template();
        echo $view->render('views/profile.html');
    }
    /**
     * interest page
     */
    function interests()
    {
        global $validator;
        if(!$_SESSION['premium']){
            $this->_f3->reroute('summary');
        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if(isset($_POST['indoor']) && $validator->validIndoor($_POST['indoor'])){
                $_SESSION['indoor'] = $_POST['indoor'];
            }
            else{

                $_SESSION['indoor'] =  (array)null;;
            }

            if(isset($_POST['outdoor']) && $validator->validOutdoor($_POST['outdoor'])){
                $_SESSION['outdoor'] = $_POST['outdoor'];
            }
            else{
                $_SESSION['outdoor'] = (array)null;
            }

           $_SESSION['member']->setIndoor($_SESSION['indoor']);
            $_SESSION['member']->setOutdoor($_SESSION['outdoor']);

            $this->_f3->reroute('summary');
        }


        $view = new Template();
        echo $view->render('views/interest.html');
    }

    /**
     * summary
     */
    function summary()
    {

        $view = new Template();
        echo $view->render('views/summary.html');
        session_destroy();

    }
}



