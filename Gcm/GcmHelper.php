<?php
namespace Gcm;

use DBManager\DbManager;
use PHP_GCM\Message;
use PHP_GCM\Sender;

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/29/16
 * Time: 10:51 AM
 */
class GcmHelper
{
    private static $_mInstance;
    private $_sender;

    /**
     * GcmHelper constructor.
     */
    public function __construct()
    {
        $this->_sender = new Sender(GcmCons::$_API_KEY);
    }


    public static function getInstance()
    {
        if (self::$_mInstance == null)
            self::$_mInstance = new GcmHelper();
        return self::$_mInstance;
    }

    /**
     * @param $userId : id of user that sending gcm.
     * @param $userSerial : notification that comes from device:
     * @param $message Message : message to send.
     */
    public function sendNotification($userId, $userSerial, $message)
    {
        $registerIds = DbManager::getInstance()->loadUserRegIds($userId, $userSerial);
        $this->_sender->sendMulti($message, $registerIds, 5);
    }

}