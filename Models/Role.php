<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:42 AM
 */
class Role
{
    private $_roleName;
    private $_group;

    function __construct($_roleName, $_group)
    {
        $this->_roleName = $_roleName;
        $this->_group = $_group;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->_roleName;
    }

    /**
     * @param mixed $roleName
     */
    public function setRoleName($roleName)
    {
        $this->_roleName = $roleName;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->_group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->_group = $group;
    }




}