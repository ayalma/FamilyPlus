<?php
/**
 * class that represent  message that system sending to user.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 2:25 PM
 */

namespace Models;


class SystemMessage
{
    private $_id;
    private $_uid;
    private $_message;

    /**
     * SystemMessage constructor.
     * @param $_id
     * @param $_uid
     * @param $_message
     */
    public function __construct($_id, $_uid, $_message)
    {
        $this->_id = $_id;
        $this->_uid = $_uid;
        $this->_message = $_message;
    }

    public static function fromJSON($json)
    {
        $obj = new SystemMessage();
        $jsonValue = json_decode($json, true);
        foreach ($jsonValue as $key => $value)
            $obj->{'_' . $key} = $value;
        return $obj;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->_uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->_uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->_message = $message;
    }
}