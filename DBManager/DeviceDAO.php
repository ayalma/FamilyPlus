<?php
namespace DBManger;
require "../vendor/autoload.php";

use Models\Device;


/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/18/16
 * Time: 9:52 AM
 */
interface DeviceDAO
{
    public function save(Device $_device, $_userID);
}