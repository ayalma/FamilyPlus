<?php

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
    private $_repeatType;
    private $_message;
    private $_users; // user that will received this events.

    function __construct(EventType $_eventType, $_date, $_users, $_message, $_repeatType)
    {
        $this->_eventType = $_eventType;
        $this->_date = $_date;
        $this->_users = $_users;
        $this->_message = $_message;
        $this->_repeatType = $_repeatType;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->_eventType;
    }

    /**
     * @param mixed $eventType
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
     * @return mixed
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



}