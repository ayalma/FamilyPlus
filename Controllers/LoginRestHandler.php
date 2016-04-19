<?php
require_once '../DBManager/DbManager.php';
include_once 'SimpleRest.php';
include_once '../Models/Device.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 10:19 PM
 */
class loginRestHandler extends SimpleRest
{
    function login()
    {
        $_device = new Device("testSErial", 23, 'Huawei', 'g730', "test reg id");

        $response["login"] = DbManager::getInstance()->save($_device, '9104801235');

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        echo json_encode($response);
    }
}