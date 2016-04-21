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
    private $_expired;

    /**
     * LoginCode constructor.
     * @param $_userId : id of user this login code belong to him/his.
     * @param $_code : login code
     * @param $_expired : is usable or no.
     */
    public function __construct($_userId, $_code)
    {
        $this->_userId = $_userId;
        $this->_code = $_code;
    }


    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }


    /**
     * @return int
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->_code = $code;
    }

    /**
     * @return boolean
     */
    public function getExpired()
    {
        return $this->_expired;
    }

    /**
     * @param boolean $expired
     */
    public function setExpired($expired)
    {
        $this->_expired = $expired;
    }
    
    

}