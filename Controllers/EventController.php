<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 9:12 AM
 */

namespace Controllers;


use DBManager\DbManager;
use Gcm\ActionType;
use Gcm\MessageType;
use Gcm\SystemMessage\GcmMessage;
use Models\Event;
use Models\EventType;
use Models\User;

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

        /** @var User $user */
        foreach ($savedEvent->getUsers() as $user) {

            $msg = new GcmMessage($savedEvent->getId(), MessageType::eventMessage, ActionType::insert);

            // if ($user != null)
            // GcmHelper::getInstance()->sendNotification($user->getMNumber(), "", $msg);

        }

    }

    /**
     * @param $userId : user id .
     * @return Event[] : array of buys item.
     */
    public function loadEvent($userId)
    {
        $events = array_merge(DbManager::getInstance()->loadEventByUserId($userId),
            DbManager::getInstance()->loadShardEvents($userId)); // merge to event  array

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

    public function loadEventTypes()
    {
        $eventTypes = DbManager::getInstance()->loadEventTypes();
        echo json_encode($eventTypes);
    }

    public function saveEventType(EventType $eventType)
    {
        $response['save'] = DbManager::getInstance()->saveEventType($eventType);
        echo json_encode($response);
    }

}