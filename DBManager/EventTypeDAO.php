<?php

/**
 * EventType Model database Access Structure
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/20/16
 * Time: 1:31 PM
 */
interface EventTypeDAO
{

    public function loadByEventId($eventId);
}