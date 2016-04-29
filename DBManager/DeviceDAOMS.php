<?php
namespace DBManager;

use Models\Device;
use mysqli;

require "../vendor/autoload.php";

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
            ',' . DBCons::$_DEVICE_COL_REGISTER_ID . ') VALUES (?,?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('sddsss', $_device->getSerial(), $_userId, $_device->getApiNumber(), $_device->getBrand(), $_device->getModel(), $_device->getRegisterId());

        return $statement->execute();
    }


    /**
     * @param $userId string: id of user.
     * @param $serial string: serial of device send this notification.
     * @return array|null   : all register id belong to user.
     */
    public function loadRegIds($userId, $serial)
    {
        $sql = 'SELECT ' . DBCons::$_DEVICE_COL_SERIAL
            . ' FROM ' . DBCons::$_DEVICE_TABLE
            . ' WHERE ' . DBCons::$_DEVICE_COL_USER_ID
            . ' = ? AND ' . DBCons::$_DEVICE_COL_SERIAL . ' !=? ';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('ds', $userId, $serial);

        $statement->bind_result($devSerial);
        $statement->execute();

        $serials = array();
        $i = 0;

        while ($statement->fetch()) {
            $serials[$i] = $devSerial;
            $i++;
        }
        $statement->close();

        return $serials;
    }
}