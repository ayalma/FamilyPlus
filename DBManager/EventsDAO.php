<?php
include_once '../Models/Event.php';
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
     * @param $userId : id of user that this id belong to him
     * @return boolean : status of saving as boolean.
     */
    public function save(Event $events);

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
}