<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/27/16
 * Time: 11:07 AM
 */

namespace Controllers;


use Firebase\JWT\JWT;

class Util
{

    /**
     * @param $requestHeaders
     * @return array|null
     */
    public static function getAuthToken($requestHeaders)
    {
        if (!isset($requestHeaders['Authorization'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            return null;
        } else {
            try {
                $acessToken = apache_request_headers()['Authorization'];
                $token = JWT::decode($acessToken, 'sampleKey', array('HS512'));
                $token = (array)$token;
                return $token;

            } catch (\Exception $e) {
                echo 'error:' . $e->getMessage();
                setHttpHeaders($_SERVER['HTTP_ACCEPT'], 401);
                return null;
            }
        }
    }
}