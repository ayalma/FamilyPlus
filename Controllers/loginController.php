<?php
require_once("LoginRestHandler.php");
require_once("TestRestHandler.php");
include_once '../Models/User.php';


/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 1:24 PM
 */


$view = "";
if (isset($_GET["view"]))
    $view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/

function setHttpHeaders($contentType, $statusCode)
{
    $statusMessage = 'Bad Request';

    header('HTTP/1.1' . " " . $statusCode . " " . $statusMessage);
    header("Content-Type:" . $contentType); // . is concatenation in php

}

switch ($view) {

    case "login":
        // to handle REST Url /LoginController/login/
        $user = new User("a", '', "", "", "");
        LoginRestHandler::getInstance()->login($user);
        break;

    case "msg":
        // to handle REST Url /mobile/show/<id>/
        /*  $mobileRestHandler = new MobileRestHandler();
          $mobileRestHandler->getMobile($_GET["id"]);*/
        LoginRestHandler::getInstance()->getstatus($_GET['id']);
        break;

    case "getUser" :
        TestRestHandler::getInstance()->getUser($_GET['userId']);
        break;
    case 'getRoles' :
        TestRestHandler::getInstance()->getRoles($_GET['userId']);
        break;
    case 'requestCode' :

        if (isset($_POST['mobileNumber'])) {
            LoginRestHandler::getInstance()->requestCode($_POST['mobileNumber']);
        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            echo 'no mobile available';
        }
        break;
}


        
        



