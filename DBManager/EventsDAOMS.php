<?php
namespace DBManager;
require "../vendor/autoload.php";

use Models\Event;
use mysqli;

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
     * @param $userId : id of owner.
     * @return Event : status of saving as boolean.
     */
    public function save(Event $events, $userId)
    {
        $sql = ' INSERT INTO ' . DBCons::$_EVENT_TABLE .
            ' ( ' . DBCons::$_EU_COL_EVENT_ID .
            ' , ' . DBCons::$_EVENT_COL_USER_ID .
            ' , ' . DBCons::$_EVENT_COL_DATE .
            ' , ' . DBCons::$_EVENT_COL_MESSAGE .
            ' , ' . DBCons::$_EVENT_COL_REPEAT_TYPE . ' )  VALUES (?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('iddsi', $events->getEventType()->getId(), $userId
            , $events->getDate(), $events->getMessage(), $events->getRepeatType());


        if ($statement->execute()) {
            $eventId = $statement->insert_id;

            echo json_encode($events->getUsers());
            for ($i = 0; $i < sizeof($events->getUsers()); $i++) {
                if (!$this->SaveReceiver($events->getUsers()[$i]->getMNumber(), $eventId))
                    $events->getUsers()[$i] = null;
            }

            $events->setId($statement->insert_id);
            $statement->close();
            return $events;

        } else {

            $statement->close();
            return null;
        }

    }

    /**
     * @param int $userId id of user that event sent to him/his.
     * @param int $eventId : id of event.
     * @return bool status of save.
     */
    public function SaveReceiver($userId, $eventId)
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
        $statement->store_result();

        if ($statement->fetch()) {

            $statement->close();
            $event = new Event($eventId, DbManager::getInstance()->loadEventTypeBuyId($eventTypeId),
                DbManager::getInstance()->loadUser($userId),
                $date, $this->loadReceiver($eventId), $message, $repeatType);
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
    private function loadReceiver($eventId)
    {
        $sql = 'SELECT ' . DBCons::$_EU_COL_USER_ID . ' FROM ' . DBCons::$_EU_TABLE .
            ' WHERE ' . DBCons::$_EU_COL_EVENT_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $eventId);

        $statement->bind_result($userId);
        $statement->execute();

        $userIds = array();
        $userIds[0] = 'no user available';

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
     * @return Event[] : array of Event.
     */
    public function loadByUserId($userId)
    {
        $sql = 'SELECT * FROM '
            . DBCons::$_EVENT_TABLE . ' WHERE '
            . DBCons::$_EVENT_COL_USER_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);

        $statement->bind_result($date, $message, $repeatType, $eventId, $eventTypeId, $userId);
        $statement->store_result();
        
        $events = array();
        $i = 0;

        while ($statement->fetch()) {
            $events[$i] = new Event($eventId, DbManager::getInstance()->loadEventTypeBuyId($eventTypeId),
                DbManager::getInstance()->loadUser($userId),
                $date, $this->loadReceiver($eventId), $message, $repeatType);
        }

        return $events;

    }


    /**
     * @param Event $events : will update in database.
     * @return boolean : status of update as boolean.
     */
    public function update(Event $events)
    {

    }

    /**
     * @param $userId : id of user.
     * @param $eventId : id of event.
     * @return boolean : status of remove as boolean.
     */
    public function delete($userId, $eventId)
    {

    }

    /**
     * @param $userId
     * @return Event[] :array of event
     */
    public function loadShardEvents($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_EVENT_TABLE
            . ' WHERE ' . DBCons::$_EVENT_COL_ID
            . ' IN (SELECT ' . DBCons::$_EU_COL_EVENT_ID
            . ' FROM ' . DBCons::$_EU_TABLE
            . ' WHERE ' . DBCons::$_EU_COL_USER_ID . '=?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);
        $statement->bind_result($date, $message, $repeatType, $eventId, $eventTypeId, $userId);
        $statement->execute();
        $statement->store_result();

        $i = 0;
        $events = array();

        while ($statement->fetch()) {
            $buys[$i] = new Event($eventId, DbManager::getInstance()->loadEventTypeBuyId($eventTypeId),
                DbManager::getInstance()->loadUser($userId),
                $date, $this->loadReceiver($eventId), $message, $repeatType);
            $i++;
        }

        $statement->close();
        return $events;

    }
}
