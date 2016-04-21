<?php
namespace Models;
/**
 * class that contains all data about events types.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 11:00 AM
 */
class EventType
{

    private $_id;
    private $_name; // name of event type

    function __construct($_id, $_name)
    {
        $this->_id = $_id;
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