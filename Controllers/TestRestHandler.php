<?php
namespace Controllers;
include_once '../vendor/autoload.php';

use DBManager\DbManager;
use Gcm\GcmHelper;
use Gcm\MessageType;
use Gcm\SystemMessage\Builder;
use Gcm\SystemMessage\SystemMessage;


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
        $builder = new Builder();

        $builder->setMsgType(MessageType::systemMessage)->setMsg("welcome to familyPlus");
        $msg = new SystemMessage($builder);

        GcmHelper::getInstance()->sendNotification($userId, "", $msg->getMessage());
    }

}