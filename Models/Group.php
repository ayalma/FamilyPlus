<?php

/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/16/2016
 * Time: 1:08 PM
 */
class Group
{
    private $_id; //Group ID
    private $_admin; //group admin
    private $_users = array(); // list of each Group Users

    /**
     * Group constructor.
     * @param $_id
     * @param $_admin
     * @param array $_users
     */
    public function __construct($_id, $_admin, array $_users)
    {
        $this->_id = $_id;
        $this->_admin = $_admin;
        $this->_users = $_users;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->_admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->_admin = $admin;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->_users;
    }

    /**
     * @param array $users
     */
    public function setUsers($users)
    {
        $this->_users = $users;
    }

}