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
        $url = '';

        $code = mt_rand(100000, 999999);
        $msg = "رمز درخواستی شما :" . $code;

        SmsManager::getInstance()->init(new Config($url, 'username', 'password', '3000853853'));
        

        $result = SmsManager::getInstance()->sendMessageV7($mobileNumber, $msg, 1111111, 1);

        if ((int)$result) {

            $user = DbManager::getInstance()->loadUser($mobileNumber);
            DbManager::getInstance()->saveLoginCode(new LoginCode($mobileNumber, $code));
            $response['register'] = ($user == null);
            $response['codeSent'] = true;
            $response['res'] = $result;

        } else {
            $response['error'] = $result;
            $statusCode = 500;
            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this->setHttpHeaders($requestContentType, $statusCode);
        }

        echo json_encode($response);
    }

    function signUp(User $user, $code)
    {
        $loginCode = DbManager::getInstance()->loadLoginCode($user->getMNumber());

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        if ($loginCode != null && $loginCode->getExpired() == false) {
            //todo set code is expired.
            $response['signUp'] = $code == $loginCode->getCode() && DbManager::getInstance()->saveUser($user);
            $response['accessToken'] = $this->getJwt($user->getMNumber(), $user->getFName());
        } else {
            $response['login'] = false;
        }

        echo json_encode($response);
    }

    private function getJwt($name, $userId)
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
                'name' => $name, //  name
            ]
        ];

        $jwt = JWT::encode($data, 'sampleKey', 'HS512');

        return $jwt;
    }

    function signIn($mobileNumber, $code)
    {
        $loginCode = DbManager::getInstance()->loadLoginCode($mobileNumber);

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $name = DbManager::getInstance()->loadUser($mobileNumber)->getFName();

        if ($loginCode != null && $loginCode->getExpired() == false) {
            //todo set code is expired.
            $response['signIn'] = $code == $loginCode->getCode();
            $response['accessToken'] = $this->getJwt($mobileNumber, $name);
        } else {
            $response['login'] = false;
        }

        echo json_encode($response);
    }
}