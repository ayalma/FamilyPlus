<?php
namespace Models;
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/18/16
 * Time: 9:47 AM
 *
 * class that represent devices that user login with him/his to our system
 * and contain information about this device .
 */
class Device
{
    private $_serial; // its id of this class
    private $_apiNumber; // api number of device
    private $_brand; // brand of device (e.g Huawei)
    private $_model; // model (e.g G730) my phone :D
    private $_registerId;

    /**
     * Device constructor.
     * @param $_serial
     * @param $_apiNumber
     * @param $_brand
     * @param $_model
     * @param $_registerId
     */
    public function __construct($_serial = '', $_apiNumber = 0, $_brand = '', $_model = '', $_registerId = '')
    {
        $this->_serial = $_serial;
        $this->_apiNumber = $_apiNumber;
        $this->_brand = $_brand;
        $this->_model = $_model;
        $this->_registerId = $_registerId;
    }

    public static function fromJSON($json)
    {
        $obj = new Device();
        $jsonValue = json_decode($json, true);
        foreach ($jsonValue as $key => $value)
            $obj->{'_' . $key} = $value;
        return $obj;

    }

    /**
     * @return mixed
     */
    public function getSerial()
    {
        return $this->_serial;
    }

    /**
     * @param mixed $serial
     */
    public function setSerial($serial)
    {
        $this->_serial = $serial;
    }

    /**
     * @return mixed
     */
    public function getApiNumber()
    {
        return $this->_apiNumber;
    }

    /**
     * @param mixed $apiNumber
     */
    public function setApiNumber($apiNumber)
    {
        $this->_apiNumber = $apiNumber;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->_brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->_brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getRegisterId()
    {
        return $this->_registerId;
    }

    /**
     * @param mixed $registerId
     */
    public function setRegisterId($registerId)
    {
        $this->_registerId = $registerId;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->_model;
    } // registration token on gcm for user device.

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->_model = $model;
    }
}