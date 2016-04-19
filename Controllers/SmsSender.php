<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/18/16
 * Time: 6:47 PM
 */
class SmsSender
{
    private $_url;
    private $_userName;
    private $_password;
    private $_number;

    private $_client;

    /**
     * SmsSender constructor.
     * @param $_url
     * @param $_userName
     * @param $_password
     * @param $_number
     */
    public function __construct($_url, $_userName, $_password, $_number)
    {
        $this->_url = $_url;
        $this->_userName = $_userName;
        $this->_password = $_password;
        $this->_number = $_number;
    }


    public function connect()
    {
        ini_set("soap.wsdl_cache_enabled", "0");
        $this->_client = new SoapClient($this->_url);
    }

    public function sendMessage($method, $mobile, $message, $type = '')
    {
        $param = array('Username' => $this->_userName,
            'Password' => $this->_password,
            'Number' => "$this->_number",
            'Mobile' => array("$mobile"),
            'Message' => "$message",
            'Type' => "$type");


        $result = $this->_client->__SoapCall($method, array($param));


        if ($type == 'object')
            return get_object_vars($result);

        $merge = $method . 'Result';

        if ($result->$merge->string != '')
            return $result->$merge->string;
        else
            return $result->$merge;
    }

    /**
     * @param $massageId : id of message that wide get to you.
     * @return mixed status of message.
     */
    public function getMessageStatus($massageId)
    {
        $param = array('Username' => "$this->_userName",
            'Password' => "$this->_password",
            'SmsID' => "$massageId");

        $method = 'GetMessageStatus';

        $result = $this->_client->__SoapCall($method, array($param));

        $merge = $method . 'Result';
        if ($result->$merge->string != '')
            return $result->$merge->string;
        else
            return $result->$merge;

    }


}