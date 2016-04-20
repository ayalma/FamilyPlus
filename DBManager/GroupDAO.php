<?php

/**
 * dao of Group model.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/20/16
 * Time: 10:19 AM
 */
interface GroupDAO
{
    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return : all groups that user is member in them.
     */
    public function loadByUserId($userId);
}