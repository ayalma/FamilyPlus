<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/26/16
 * Time: 11:34 AM
 */

namespace Controllers;


use DBManager\DbManager;
use Models\Device;

class DeviceController extends SimpleRest
{

    private static $_instance = null;

    /**
     * LoginRestHandler constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new DeviceController();
        return self::$_instance;
    }

    public function registerDevice(Device $device, $userId)
    {
        $response['register'] = DbManager::getInstance()->save($device, $userId);
        echo $response;
    }
}