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

    public static function fromJSON($json)
    {
        $obj = new Group();
        $jsonValue = json_decode($json, true);
        foreach ($jsonValue as $key => $value)
            $obj->{'_' . $key} = $value;
        return $obj;

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
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }
    
    
    

}