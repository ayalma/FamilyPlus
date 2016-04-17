<?php
require_once("LoginRestHandler.php");

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
switch ($view) {

    case "login":
        // to handle REST Url /LoginController/login/
        $loginRestHandler = new loginRestHandler();
        $loginRestHandler->login();
        break;

    case "single":
        // to handle REST Url /mobile/show/<id>/
        /*  $mobileRestHandler = new MobileRestHandler();
          $mobileRestHandler->getMobile($_GET["id"]);*/
        break;

    case "" :
        //404 - not found;
        break;
}
?>

        
        



