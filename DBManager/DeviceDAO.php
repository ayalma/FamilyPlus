<?php
include_once '../Models/Device.php';

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