<?php
namespace DBManger;
require "../vendor/autoload.php";
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:44 PM
 */
interface RoleDAO
{
    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return  array : all role of user in his groups peerTopPeer.
     */
    public function loadByUserID($userId);
}