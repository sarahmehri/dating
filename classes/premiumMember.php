<?php

/**
 * Class PremiumMember
 * @author sarah
 * @version 1.0
 */
class PremiumMember extends Member {

    private $_indoor;
    private $_outdoor;

    /**
     * return indoor interests
     * @return mixed
     */
    public function getIndoor()
    {
        return $this->_indoor;
    }

    /**
     * setter
     * @param mixed $indoor
     */
    public function setIndoor($indoor)
    {
        $this->_indoor = $indoor;
    }

    /**
     * returns outdoor interest
     * @return mixed outdoor interests
     */
    public function getOutdoor()
    {
        return $this->_outdoor;
    }

    /**
     * setter
     * @param mixed $outdoor
     */
    public function setOutdoor($outdoor)
    {
        $this->_outdoor = $outdoor;
    }
}