<?php
namespace Controllers;
require "../vendor/autoload.php";


/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 1:24 PM
 */


$view = "";
if (isset($_GET["view"]))
    $view = $_GET["view"];

$deviceSerial = Util::getDeviceSerial(apache_request_headers());


function setHttpHeaders($contentType, $statusCode)
{
    $statusMessage = 'Bad Request';

    header('HTTP/1.1' . " " . $statusCode . " " . $statusMessage);
    header("Content-Type:" . $contentType); // . is concatenation in php

}

switch ($view) {

    case "signIn":

        if (isset($_POST['code']) && isset($_POST['mobileNumber']) && $_POST['register']) {

            $code = $_POST['code'];
            $mobileNumber = $_POST['mobileNumber'];
            $register = $_POST['register'];

            LoginController::getInstance()->signIn($mobileNumber, $code, $register);
        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            echo 'bad request';
        }

        break;
    case 'requestCode' :

        if (isset($_POST['mobileNumber'])) {
            LoginController::getInstance()->requestCode($_POST['mobileNumber']);
        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            echo 'no mobile available';
        }
        break;
    case 'updateName' :

        $authToken = Util::getAuthToken(apache_request_headers());

        if ($authToken == null)
            break;

        if (!isset($_POST['name'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }

        $data = $authToken['data'];
        $userId = $data->userId;
        LoginController::getInstance()->updateName($userId, $_POST['name']);
        break;
   
}





