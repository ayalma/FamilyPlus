<?php

include_once 'DeviceDAO.php';
include_once '../Models/Device.php';
include_once 'DBCons.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/18/16
 * Time: 9:53 AM
 */
class DeviceDAOMS implements DeviceDAO
{
    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    public function save(Device $_device, $_userId)
    {

        $sql = 'INSERT INTO ' . DBCons::$_DEVICE_TABLE .
            ' (' . DBCons::$_DEVICE_COL_SERIAL .
            ',' . DBCons::$_DEVICE_COL_USER_ID .
            ',' . DBCons::$_DEVICE_COL_API_NUMBER .
            ',' . DBCons::$_DEVICE_COL_BRAND .
            ',' . DBCons::$_DEVICE_COL_MODEL .
            ',' . DBCons::$_DEVICE_COL_REGISTER_ID . ') Values (?,?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('sddsss', $_device->getSerial(), $_userId, $_device->getApiNumber(), $_device->getBrand(), $_device->getModel(), $_device->getRegisterId());

        return $statement->execute();
    }
}