<?php

include_once 'EventTypeDAO.php';
include_once '../Models/EventType.php';
include_once 'DBCons.php';

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

    /**
     * @param int $eventTypeId id of event type.
     * @return EventType|null : eventType or null if id don't exist.
     */
    public function loadByEventId($eventTypeId)
    {
        $sql = 'SELECT ' . DBCons::$_EVENTTYPE_COL_NAME . ' from ' .
            DBCons::$_EVENTTYPE_TABLE .
            ' WHERE ' . DBCons::$_EVENTTYPE_COL_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $eventTypeId);
        $statement->bind_result($name);

        $statement->execute();
        if ($statement->fetch()) {
            $statement->close();
            return new EventType($eventTypeId, $name);
        } else {
            $statement->close();
            return null;
        }
    }

    /**
     * @param EventType $eventType will save in db.
     * @return boolean return save status as boolean.
     */
    public function save(EventType $eventType)
    {
        $sql = 'INSERT INTO ' . DBCons::$_EVENTTYPE_TABLE .
            ' (' . DBCons::$_EVENTTYPE_COL_NAME . ') VALUES (?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('s', $eventType->getName());


        $result = $statement->execute();
        $statement->close();

        return $result;
    }
}