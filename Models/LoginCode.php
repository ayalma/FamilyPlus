<?php

/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/19/2016
 * Time: 7:31 PM
 */
class LoginCode
{
    private $_userId;
    private $_code;

    /**
     * LoginCode constructor.
     * @param $_userId
     * @param $_code
     */
    public function __construct($_userId, $_code)
    {
        $this->_userId = $_userId;
        $this->_code = $_code;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
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