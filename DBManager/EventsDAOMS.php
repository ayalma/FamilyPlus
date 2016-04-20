<?php

include_once 'EventsDAO.php';
include_once '../Models/Event.php';
include_once 'DBCons.php';
include_once 'DbManager.php';

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
        $eventId = $statement->insert_id;
        $res = false;
        if ($result) {

            foreach ($events->getUsers() as $userId)
                $res = $this->SaveUser($userId, $eventId);
        }
        return $res && $result;

    }

    /**
     * @param Event $events
     * @return bool
     */
    private function SaveUser($userId, $eventId)
    {
        $sql = ' INSERT INTO ' . DBCons::$_EU_TABLE .
            ' ( ' . DBCons::$_EU_COL_USER_ID .
            ' , ' . DBCons::$_EU_COL_EVENT_ID . ' )  VALUES (?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('di', $userId, $eventId);
        $res = $statement->execute();
        return $res;

    }

    /**
     * @param $eventId : id of event.
     * @return Event : event that match with id.
     */
    public function loadById($eventId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_EVENT_TABLE . ' WHERE ' . DBCons::$_EVENT_COL_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $eventId);

        $statement->bind_result($eventId, $eventTypeId, $userId, $date, $message, $repeatType);
        $statement->execute();

        if ($statement->fetch()) {

            $statement->close();
            $event = new Event(DbManager::getInstance()->loadEventType($eventTypeId),
                DbManager::getInstance()->loadUser($userId),
                $date, $this->loadUser($eventId), $message, $repeatType);
            return $event;

        } else {
            $statement->close();
            return null;
        }
    }

    /**
     * @param $eventId : id of event will send to user.
     * @return array : id of users that message send to him/his.
     */
    private function loadUser($eventId)
    {
        $sql = 'SELECT ' . DBCons::$_EU_COL_USER_ID . ' FROM ' . DBCons::$_EU_TABLE .
            ' WHERE ' . DBCons::$_EU_COL_EVENT_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $eventId);

        $statement->bind_result($userId);
        $statement->execute();

        $userIds = array();
        $userIds[0] = 'now user available';

        $i = 0;
        while ($statement->fetch()) {
            $userIds[$i] = $userId;
            $i++;
        }
        $statement->close();
        return $userIds;

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