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

    case "signUp":

        if (isset($_POST['user']) && $_POST['code']) {
            $code = $_POST['code'];
            // $user = User::fromJSON()$_POST['user'];
            //LoginRestHandler::getInstance()->signIn($mobileNumber, $code);
        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            echo headers_list();
        }

        break;

    case "signIn":

        if (isset($_POST['code']) && isset($_POST['mobileNumber'])) {

            $code = $_POST['code'];
            $mobileNumber = $_POST['mobileNumber'];
            LoginRestHandler::getInstance()->signIn($mobileNumber, $code);
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
}


        
        



