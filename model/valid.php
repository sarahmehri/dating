<?php

    function validName($name)
    {
        return !empty($name) && ctype_alpha($name);
    }


    function validAge($age)
    {

        return is_numeric($age) && $age >= 18 && $age <= 118;
    }


    function validPhone($phone)
    {

        return is_numeric($phone) && strlen((string)$phone) == 10;
    }


    function validGender($gender)
    {

        return in_array($gender, getGenders());
    }


    function validState($state)
    {

        return in_array($state, getStates());
    }


    function validEmail($email)
    {
        return preg_match('^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^', $email);
    }


    function validOutdoor($outdoorInterests)
    {
        foreach($outdoorInterests as $interest) {
            if(!in_array($interest, getOutdoor())) {
                return false;
            }
        }
        return true;
    }


    function validIndoor($indoorInterests)
    {
        foreach($indoorInterests as $interest) {
                if(!in_array($interest, getIndoor())) {
                    return false;
                }
            }
            return true;
    }

