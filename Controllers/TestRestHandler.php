<?php
namespace Controllers;
include_once '../vendor/autoload.php';

use DBManager\DbManager;
use Gcm\ActionType;
use Gcm\GcmHelper;
use Gcm\MessageType;
use Gcm\SystemMessage\GcmMessage;


/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/19/16
 * Time: 11:36 AM
 */
class TestRestHandler extends SimpleRest
{

    private static $_instance = null;

    /**
     * TestRestHandler constructor.
     */
    public function __construct()
    {
    }


    public static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new TestRestHandler();
        return self::$_instance;
    }

    public function getUser($userId)
    {
        /* $user = new User();
         $user = User::fromJSON('{"fName":"ali","mNumber":"12"}', $user);*/
        $user = DbManager::getInstance()->loadUser($userId);

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $respons['userId'] = $userId;
        $respons['fname'] = $user->getFName();
        $respons['user'] = $user;

        echo json_encode($respons);
    }


    public function SendNotification($userId)
    {

        $msg = new GcmMessage(2, MessageType::eventMessage, ActionType::insert);
        GcmHelper::getInstance()->sendNotification($userId, "", $msg);
    }

}