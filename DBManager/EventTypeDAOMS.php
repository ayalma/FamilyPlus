<?php

include_once 'EventTypeDAO.php';
include_once '../Models/EventType.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/20/16
 * Time: 1:32 PM
 */
class EventTypeDAOMS implements EventTypeDAO
{

    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    public function loadByEventId($eventId)
    {
        // TODO: Implement loadByEventId() method.
    }
}