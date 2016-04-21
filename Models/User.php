<?php
namespace Models;

use JsonSerializable;

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:39 AM
 */
class User implements JsonSerializable
{
    private $_fName;
    private $_mNumber; // mobile number

    /* private $_groups = array(); // list of group belong to user
     private $_roles = array(); // list of role belong to user
     private $_buyItems = array();// list of buyItem belong to user*/


    function __construct($_fName = "", $_mNumber = "")
    {
        $this->_fName = $_fName;
        $this->_mNumber = $_mNumber;
    }

    public static function fromJSON($json, $obj)
    {
        $jsonValue = json_decode($json, true);
        foreach ($jsonValue as $key => $value)
            $obj->{'_' . $key} = $value;
        return $obj;

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
        return $json; // or json_encode($json)
    }
}