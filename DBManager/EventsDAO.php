<?php
namespace DBManager;
require "../vendor/autoload.php";
use Models\Event;

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:46 PM
 */
interface EventsDAO
{
    /**
     * @param Event $events : will save in database.
     * @return boolean : status of saving as boolean.
     */
    public function save(Event $events, $userId);

    
    /**
     * @param $eventId : id of event.
     * @return Event : event that match with id.
     */
    public function loadById($eventId);

    /**
     * @param $userId : of user that event is for him/his.
     * @return array : array of Event.
     */
    public function loadByUserId($userId);

    /**
     * @param $userId
     * @return array:array of event
     */
    public function loadShardEvents($userId);
    

    /**
     * @param Event $events : will update in database.
     * @return boolean : status of update as boolean.
     */
    public function update(Event $events);

    /**
     * @param $eventId : id of event.
     * @return boolean : status of remove as boolean.
     */
    public function delete($eventId);
}