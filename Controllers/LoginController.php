<?php
namespace Controllers;
require "../vendor/autoload.php";

use DBManager\DbManager;
use Firebase\JWT\JWT;
use ir\ayalma\SmsSender\Config;
use ir\ayalma\SmsSender\SmsManager;
use Models\LoginCode;
use Models\User;

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 10:19 PM
 */
class LoginController extends SimpleRest
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
            self::$_instance = new LoginController();
        return self::$_instance;
    }

    function requestCode($mobileNumber)
    {
        $url = '';

        $code = mt_rand(100000, 999999);
        $msg = "رمز درخواستی شما:" . $code . "\n طراحی وتوسعه : www.ayalma.ir";

        SmsManager::getInstance()->init(new Config($url, 'mohsencomp90@gmail.com', 'messicr7', '3000853853'));

        $result = SmsManager::getInstance()->sendMessageV7($mobileNumber, $msg, 1111111, 1);

        if ((int)$result) {

            $user = DbManager::getInstance()->loadUser($mobileNumber);
            DbManager::getInstance()->saveLoginCode(new LoginCode($mobileNumber, $code));
            $response['register'] = ($user == null);
            $response['codeSent'] = true;
            $response['res'] = $result;

        } elseif ($result == 'TimeOut') {
            $user = DbManager::getInstance()->loadUser($mobileNumber);
            DbManager::getInstance()->saveLoginCode(new LoginCode($mobileNumber, $code));
            $response['register'] = ($user == null);
            $response['codeSent'] = true;
            $response['res'] = $result;
            //todo check if sms checkin id send to afe.ir get msgId and check message status.
        } else {
            $response['error'] = $result;
            $statusCode = 500;
            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this->setHttpHeaders($requestContentType, $statusCode);
        }

        echo json_encode($response);
    }

    function updateName($userId, $name)
    {

        $res = DbManager::getInstance()->updateUserName($userId, $name);

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        $response['update'] = $res;
        echo json_encode($response);
    }

    function signIn($mobileNumber, $code, $register)
    {
        $loginCode = DbManager::getInstance()->loadLoginCode($mobileNumber);

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        if ($loginCode != null && $loginCode->getExpired() == false && $loginCode->getCode() == $code) {
            //todo set code is expired.
            if ($register)
                DbManager::getInstance()->saveUser(new User('', $mobileNumber));

            $response['signIn'] = true;
            $response['accessToken'] = $this->getJwt($mobileNumber);

        } else {
            // $response['loginCode'] = $loginCode->getCode();
            $response['signIn'] = false;
            $response['accessToken'] = "hello";
        }

        echo json_encode($response);
    }

    private function getJwt($userId)
    {
        $tokenId = base64_encode(mcrypt_create_iv(32));
        $issuedAt = time();
        $notBefore = $issuedAt + 10;             //Adding 10 seconds
        $serverName = 'familyPlus Server'; // Retrieve the server name from config file

        /*
         * Create the token as an array
         */
        $data = [
            'iat' => $issuedAt,         // Issued at: time when the token was generated
            'jti' => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss' => $serverName,       // Issuer
            'nbf' => $notBefore,        // Not before
            'data' => [                  // Data related to the signer user
                'userId' => $userId, // userId from the users table
            ]
        ];

        $jwt = JWT::encode($data, 'sampleKey', 'HS512');

        return $jwt;
    }
}