<?php
namespace DBManager;
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

    /**
     * @param $userId string: id of user.
     * @param $serial string: serial of device send this notification.
     * @return array|null   : all register id belong to user.
     */
    public function loadRegIds($userId, $serial);
}