<?php
namespace Controllers;
require "../vendor/autoload.php";
use Models\Group;


/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 1:24 PM
 */


$view = "";
if (isset($_GET["view"]))
    $view = $_GET["view"];


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

            LoginRestHandler::getInstance()->signIn($mobileNumber, $code, $register);
        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            echo 'bad request';
        }

        break;
    case 'requestCode' :

        if (isset($_POST['mobileNumber'])) {
            LoginRestHandler::getInstance()->requestCode($_POST['mobileNumber']);
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
        LoginRestHandler::getInstance()->updateName($userId, $_POST['name']);
        break;
    case 'creatGroup':
        $inputJSON = file_get_contents('php://input');
        if ($inputJSON != null) {

            $group = Group::fromJSON($inputJSON);
            GroupController::getInstance()->save($group);
        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        break;
    case 'AddMember' :

        if (!isset($_POST['groupId']) || !isset($_POST['memberId']) || !isset($_POST['role'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        GroupController::getInstance()->AddMember($_POST['groupId'], $_POST['memberId'] , $_POST['role']);
        break;
    case 'DeleteMember' :

        if (!isset($_POST['groupId']) || !isset($_POST['userId'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        GroupController::getInstance()->DeleteMember($_POST['groupId'], $_POST['userId'] );
        break;
   
}





