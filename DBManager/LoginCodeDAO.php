<?php
namespace DBManager;
require "../vendor/autoload.php";
use Models\LoginCode;
use Models\User;


/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/19/2016
 * Time: 7:44 PM
 */
interface LoginCodeDAO
{

    /**
     * @param LoginCode $LoginCode will save in db
     * @return boolean return status of saving.
     */
    public function save(LoginCode $LoginCode);

    /**
     * @param $userId : id of requested user.
     * @return User that contains requested userId.
     */
    public function load($userId);

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return  : all role of user in his groups peerTopPeer.
     */
}