<?php
namespace Models;

use namespacetest\model\UserList;

include_once 'User.php';
include_once 'EventType.php';
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:43 AM
 */
class Event implements \JsonSerializable
{
    private $_id;
    private $_eventType;
    private $_date;
    private $_owner;
    private $_repeatType;
    private $_message;
    private $_users; // user that will received this events.

    function __construct($id = 0, EventType $_eventType = null, User $_owner = null, $_date = 0, $_users = array(), $_message = '', $_repeatType = 0)
    {
        $this->_id = $id;
        $this->_eventType = $_eventType;
        $this->_owner = $_owner;
        $this->_date = $_date;
        $this->_users = $_users;
        $this->_message = $_message;
        $this->_repeatType = $_repeatType;
    }

    public static function fromJSON($json)
    {
        $obj = new Event();

        $jsonValue = json_decode($json, true);
        foreach ($jsonValue as $key => $value)
            $obj->{'_' . $key} = $value;

        return $obj;

    }

    /**
     * @return EventType
     */
    public function getEventType()
    {
        return $this->_eventType;
    }

    /**
     * @param EventType $eventType
     */
    public function setEventType($eventType)
    {
        $this->_eventType = $eventType;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return mixed
     */
    public function getRepeatType()
    {
        return $this->_repeatType;
    }

    /**
     * @param mixed $repeatType
     */
    public function setRepeatType($repeatType)
    {
        $this->_repeatType = $repeatType;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->_message = $message;
    }

    /**
     * @return UserList
     */
    public function getUsers()
    {
        return $this->_users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->_users = $users;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->_owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->_owner = $owner;
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