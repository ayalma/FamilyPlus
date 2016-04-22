<?php
namespace DBManager;

require "../vendor/autoload.php";
use Models\EventType;

/**
 * EventType Model database Access Structure
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/20/16
 * Time: 1:31 PM
 */
interface EventTypeDAO
{

    /**
     * @param EventType $eventType will save in db.
     * @return boolean return save status as boolean.
     */
    public function save(EventType $eventType);

    /**
     * @param int $eventTypeId id of event type.
     * @return EventType|null : eventType or null if id don't exist.
     */
    public function loadByEventId($eventTypeId);
}