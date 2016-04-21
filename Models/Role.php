<?php
namespace Models;

use JsonSerializable;

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:42 AM
 */
class Role implements JsonSerializable
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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $json = array();

        foreach ($this as $key => $value) {
            $key = str_replace('_', '', $key);
            $json[$key] = $value;
        }

        return $json;
    }
}