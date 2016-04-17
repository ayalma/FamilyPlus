<?php

include_once 'EventsDAO.php';
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:46 PM
 */
class EventsDAOMS implements EventsDAO
{
    private $_connection;

    function __construct($_connection)
    {
        $this->_connection = $_connection;
    }

}