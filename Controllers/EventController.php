<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 9:12 AM
 */

namespace Controllers;


use DBManager\DbManager;

class EventController
{
    private static $_instance = null;

    /**
     * GroupController constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new EventController();
        }
        return self::$_instance;
    }

    /**
     * @param $event : event object .
     * @param $userId : id of user..
     */
    public function saveEvents($event, $userId)
    {
        $savedEvent = DbManager::getInstance()->saveEvent($event, $userId);
        echo json_encode($savedEvent);
    }

    /**
     * @param $userId : user id .
     * @return array : array of buys item.
     */
    public function loadEvent($userId)
    {
        $events = array_merge(DbManager::getInstance()->loadEventByUserId($userId),
            DbManager::getInstance()->loadShardEvents($userId)); // merge to buys items array

        echo json_encode($events);
    }

    /**
     * @param int $eventId : id of event.
     * @param int $userId : id of user.
     * @return bool : status of saving.
     */
    public function addReceiver($eventId, $userId)
    {
        $response['save'] = true;

        if (is_array($userId)) {
            foreach ($userId as $id) {
                $response['save'] = $response['save'] && DbManager::getInstance()->SaveEventReceiver($id, $eventId);
            }
        } else {
            $response['save'] = DbManager::getInstance()->SaveEventReceiver($userId, $eventId);
        }
        echo json_encode($response);
    }

    /**
     * @param $eventId : id of event .
     * @return array : user who access to this buy.
     */
    public function getReceiver($eventId)
    {
        //todo implement this method
    }

    /**
     * @param $eventId : id of event.
     * @return bool :
     */
    public function deletBuy($eventId)
    {
        //todo implement this method
    }

}