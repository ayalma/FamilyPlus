<?php

/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/19/2016
 * Time: 7:31 PM
 */
class LoginCode
{
    private $_uid;
    private $_code;

    /**
     * LoginCode constructor.
     * @param $_id
     * @param $_uid
     * @param $_code
     */
    public function __construct($_uid, $_code)
    {
        $this->_uid = $_uid;
        $this->_code = $_code;
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
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->_code = $code;
    }
    

}