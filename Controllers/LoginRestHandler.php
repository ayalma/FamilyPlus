<?php
require_once '../DBManager/DbManager.php';
include_once 'SimpleRest.php';
include_once '../Models/Device.php';
include_once 'SmsSender.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 10:19 PM
 */
class LoginRestHandler extends SimpleRest
{
    private static $_instance = null;

    /**
     * LoginRestHandler constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new LoginRestHandler();
        return self::$_instance;
    }

    function requestCode($mobileNumber)
    {
        //send messsage to phone number and send notification to him.
        $url = 'http://www.afe.ir/WebService/V5/BoxService.asmx?wsdl';
        $smsSender = new SmsSender($url, "alimohammadi350@gmail.com", "gamor2012", "3000853853");


        $msg = 'رمز درخواستی شما :2225';

        $method = 'SendMessage';


        $smsSender->connect();

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        $result = $smsSender->sendMessage($method, $mobileNumber, $msg, '1');

        if ((int)$result) {
            DbManager::getInstance()->saveLoginCode(new LoginCode($mobileNumber, 2225));
            $response['code'] = 2225;
            $response['res'] = $result;
        } else
            $response['error'] = $result;

        echo json_encode($response);
    }

    function login(User $user)
    {

        // $response["login"] = DbManager::getInstance()->save($_device, "12");

        //send messsage to phone number and send notification to him.
        $url = 'http://www.afe.ir/WebService/V5/BoxService.asmx?wsdl';
        $smsSender = new SmsSender($url, "username", "password", "number");

        $mobile = '0xxxxxxxxxx';
        $msg = 'رمز درخواستی شما :2225';

        $method = 'SendMessage';


        $smsSender->connect();

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        $response['msg status'] = $smsSender->sendMessage($method, $mobile, $msg, '1');

        echo json_encode($response);
    }

    function getstatus($msgId)
    {

        $url = 'http://www.afe.ir/WebService/V5/BoxService.asmx?wsdl';
        $smsSender = new SmsSender($url, "alimohammadi350@gmail.com", "gamor2012", "3000853853");
        $smsSender->connect();

        $response['msgStatus'] = $smsSender->getMessageStatus($msgId);
        echo json_encode($response);
    }
}