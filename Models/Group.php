<?php
namespace Models;
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/16/2016
 * Time: 1:08 PM
 */
class Group
{
    private $_id;    //Group ID
    private $_admin; //group admin
    private $_name; //group name.

    /**
     * Group constructor.
     * @param $_id
     * @param $_admin
     * @param $_name
     */
    public function __construct($_id, $_admin, $_name)
    {
        $this->_id = $_id;
        $this->_admin = $_admin;
        $this->_name = $_name;
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
    

}