<?php

/**
 * Class DataLayer
 * this class give data or return data from database
 * @author Sarah
 * @version 1.0
 */
class DataLayer
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * insertion to member table
     * @param $member Object
     */
    function insertMember($member){

        //build query
        $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests)
        VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);
        $premium = $member instanceof PremiumMember;
        global $interests;
        //if the premium is true or equal 1,
        // merge the array of interests and put it to interests
        if($premium){
            $interests = implode(", ", array_merge($member->getIndoor(),
                $member->getOutdoor()));
        }


        //bind the parameters
        $statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $member->getAge(), PDO::PARAM_STR);
        $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        //process results
        $statement->execute();

    }


    /**
     * this function return the member info and ordered by last name
     * @return mixed
     */
    function getMembers(){
        //Build query
        $sql = "SELECT * FROM member ORDER BY lname";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Process results
        $statement->execute();
        //get result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function getMember($member_id){
        $sql = "SELECT * FROM member WHERE member_id = :member_id";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    function getInterests($member_id){
        $sql = "SELECT interests FROM member WHERE member_id = :member_id";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @return string[] of genders to display in page
     */
    function getGenders()
    {
        return array('Male', 'Female');
    }

    /**
     * @return string[] returns states
     */
    function getStates()
    {
        return array('Alabama','Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
            'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana',
            'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts',
            'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana, Nebraska', 'Nevada',
            'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina',
            'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
            'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia',
            'Washington', 'West Virginia', 'Wisconsin', 'Wyoming');
    }

    /**
     * @return string[] returns indoor interests
     */
    function getIndoor()
    {
        return array('tv', 'movies', 'cooking', 'board Games', 'puzzles', 'reading', 'playing cards', 'video games');
    }

    /**
     * @return string[] return outdoor interests
     */
    function getOutdoor()
    {
        return array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing');
    }
}