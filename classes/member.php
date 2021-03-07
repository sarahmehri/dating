<?php

/**
 * Class Member
 * @author Sarah
 * @version 1.0
 */
class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;
/**
* constructor
* @param $_fname String name
* @param $_lname String last name
* @param $_age Number age
* @param $_gender String gender
* @param $_phone Number phone
*/
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    /**
     * return name
     * @return String name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Setter
     * @param String name
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * return last name
     * @return String last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Setter
     * @param String last name
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * return age
     * @return Number age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * setter
     * @param Number $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * return gender
     * @return String gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Sets the member's gender
     * @param String $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * return phone number
     * @return Number phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Setter
     * @param Number $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * return email address
     * @return mixed email address
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Setter
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * return state
     * @return mixed state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * setter
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * return
     * @return mixed seeking gender
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * setter
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * return bio
     * @return mixed bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * setter
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}