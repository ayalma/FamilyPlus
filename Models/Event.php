<?php
namespace Models;
include_once 'User.php';
include_once 'EventType.php';
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:43 AM
 */
class Event
{
    private $_eventType;
    private $_date;
    private $_user;
    private $_repeatType;
    private $_message;
    private $_users; // user that will received this events.

    function __construct(EventType $_eventType, User $_user, $_date, $_users, $_message, $_repeatType)
    {
        $this->_eventType = $_eventType;
        $this->_user = $_user;
        $this->_date = $_date;
        $this->_users = $_users;
        $this->_message = $_message;
        $this->_repeatType = $_repeatType;
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
     * @return array
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
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }
    
    



}