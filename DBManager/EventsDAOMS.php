<?php

include_once 'EventsDAO.php';
include_once '../Models/Event.php';
include_once 'DBCons.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:46 PM
 */
class EventsDAOMS implements EventsDAO
{
    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }


    /**
     * @param Event $events : will save in database.
     * @param $userId : id of user that this id belong to him
     * @return boolean : status of saving as boolean.
     */
    public function save(Event $events)
    {
        $sql = ' INSERT INTO ' . DBCons::$_EVENT_TABLE .
            ' ( ' . DBCons::$_EU_COL_EVENT_ID .
            ' , ' . DBCons::$_EVENT_COL_USER_ID .
            ' , ' . DBCons::$_EVENT_COL_DATE .
            ' , ' . DBCons::$_EVENT_COL_MESSAGE .
            ' , ' . DBCons::$_EVENT_COL_REPEAT_TYPE . ' )  VALUES (?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('idisi', $events->getEventType()->getId(), $events->getUser()->getMNumber()
            , $events->getDate(), $events->getMessage(), $events->getRepeatType());

        $result = $statement->execute();

        if ($result) {
            $sql = ' INSERT INTO ' . DBCons::$_EU_TABLE .
                ' ( ' . DBCons::$_EU_COL_USER_ID .
                ' , ' . DBCons::$_EU_COL_EVENT_ID . ' )  VALUES (?,?)';

            $statement = $this->_connection->prepare($sql);
            
            $statement->bind_param('di', $events->getUser()->getMNumber(), $events->getEventType()->getId());

            $res = $statement->execute();
        }
        return $res && $result;
    }

    /**
     * @param $eventId : id of event.
     * @return Event : event that match with id.
     */
    public function loadById($eventId)
    {

    }

    /**
     * @param $userId : of user that event is for him/his.
     * @return array : array of Event.
     */
    public function loadByUserId($userId)
    {
        // TODO: Implement loadByUserId() method.
    }
}