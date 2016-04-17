<?php
require_once '../DBManager/DbManager.php';
include_once 'SimpleRest.php';

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

        $response["login"] = DbManager::getInstance()->save();

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        echo json_encode($response);
    }
}