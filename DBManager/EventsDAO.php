<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:46 PM
 */
interface EventsDAO
{
    
    public function save(Events $events , $userId);

    public function loadById($eventId);

    public function loadByUserId($eventId);
}