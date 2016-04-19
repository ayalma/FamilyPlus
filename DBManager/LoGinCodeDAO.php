<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/19/2016
 * Time: 7:44 PM
 */
interface LoGinCodeDAO
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
}