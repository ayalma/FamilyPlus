<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:45 AM
 */
interface UserDAO
{

    /**
     * @param User $user user will be save in data base.
     * @return mixed status of saving as boolean.
     */
    public function save(User $user);

    /**
     * @param $userId : id of requested user.
     * @return user that contains requested userId.
     */
    public function load($userId);

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return  : all role of user in his groups peerTopPeer.
     */
    public function getRoles($userId);

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return : all groups that user is member in them.
     */
    public function getGroups($userId);

    /**
     * @param $userId : id of user (it is him/his phone number)
     * @return : all buyItems belong to user.
     */
    public function getBuyItems($userId);
}