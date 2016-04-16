<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:39 AM
 */
class User
{
    private $_fName;
    private $_mNumber; // mobile number
    private $_groups = array(); // list of group belong to user
    private $_roles = array(); // list of role belong to user
    private $_buyItems = array();// list of buyItem belong to user

    function __construct($_fName, $_mNumber, $_groups, $_roles, $_buyItems)
    {
        $this->_fName = $_fName;
        $this->_mNumber = $_mNumber;
        $this->_groups = $_groups;
        $this->_roles = $_roles;
        $this->_buyItems = $_buyItems;
    }

    /**
     * @return mixed
     */
    public function getFName()
    {
        return $this->_fName;
    }

    /**
     * @param mixed $fName
     */
    public function setFName($fName)
    {
        $this->_fName = $fName;
    }

    /**
     * @return mixed
     */
    public function getMNumber()
    {
        return $this->_mNumber;
    }

    /**
     * @param mixed $mNumber
     */
    public function setMNumber($mNumber)
    {
        $this->_mNumber = $mNumber;
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->_groups;
    }

    /**
     * @param array $groups
     */
    public function setGroups($groups)
    {
        $this->_groups = $groups;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->_roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->_roles = $roles;
    }

    /**
     * @return array
     */
    public function getBuyItems()
    {
        return $this->_buyItems;
    }

    /**
     * @param array $buyItems
     */
    public function setBuyItems($buyItems)
    {
        $this->_buyItems = $buyItems;
    }





}