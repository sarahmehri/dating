<?php

/**
 * Class Validate
 * @author Sarah
 * @version 1.0
 */
class Validate
{
    private $_dataLayer;
    //constructor to instantiate the DataLayer class
    public function __construct($dataLayer)
    {
        $this->_dataLayer = $dataLayer;
    }

    /**
     * validate the name
     * @param $name String of name
     * @return boolean if thats right or false
     */
    function validName($name)
    {
        return !empty($name) && ctype_alpha($name);
    }

    /**
     * validate the age
     * @param $age Number to be between 18
     * @return boolean true or false if valid
     */
    function validAge($age)
    {
        return is_numeric($age) && $age >= 18 && $age <= 118;
    }

    /**
     * validate the phone number
     * @param $phone Number to be a number
     * @return boolean see if they are valide
     */
    function validPhone($phone)
    {
        return strlen((string)$phone) == 10 && is_numeric($phone);
    }

    /**
     * validate age
     * @param $gender String gender entered
     * @return boolean
     */
    function validGender($gender)
    {
        return in_array($gender, $this->_dataLayer->getGenders());
    }

    /**
     * validate states to not spoof
     * @param $state String state selected
     * @return boolean
     */
    function validState($state)
    {
        return in_array($state, $this->_dataLayer->getStates());
    }

    /**
     * valid email address myexample@mail.com
     * @param $email String
     * @return boolean
     */
    function validEmail($email)
    {
        return preg_match('^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^', $email);
    }

    /**
     * validate to not spoof
     * @param $outdoor String of selected options
     * @return boolean
     */
    function validOutdoor($outdoorInterests)
    {
        //For each element in array, check it is in the data-layer.php array
        foreach($outdoorInterests as $interest) {
            if(!in_array($interest, $this->_dataLayer->getOutdoor())) {
                return false;
            }
        }
        return true;
    }

    /**
     * validate the indoor interest to not be spoof
     * @param $indoor String selected option
     * @return boolean
     */
    function validIndoor($indoorInterests)
    {
        foreach($indoorInterests as $interest) {
            if(!in_array($interest, $this->_dataLayer->getIndoor())) {
                return false;
            }
        }
        return true;//if selected interests are right not spoofed return true
    }
}