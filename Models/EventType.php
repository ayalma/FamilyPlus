<?php
namespace Models;
/**
 * class that contains all data about events types.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 11:00 AM
 */
class EventType implements \JsonSerializable
{

    private $_id;
    private $_name; // name of event type

    function __construct($_id = 0, $_name = '')
    {
        $this->_id = $_id;
        $this->_name = $_name;
    }

    public static function fromJSON($json)
    {
        $obj = new EventType();

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