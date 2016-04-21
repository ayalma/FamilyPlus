<?php
namespace DBManger;
require "../vendor/autoload.php";
use Models\User;


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
    
}