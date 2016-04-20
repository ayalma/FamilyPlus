<?php

include_once 'GroupDAO.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/20/16
 * Time: 10:20 AM
 */
class GroupDAOMS implements GroupDAO
{

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return : all groups that user is member in them.
     */
    public function loadByUserId($userId)
    {
        // TODO: Implement loadByUserId() method.
    }
}