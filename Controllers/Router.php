<?php
/**
 * class for rutting all request to proper controller.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/26/16
 * Time: 11:21 AM
 */

namespace Controllers;
require "../vendor/autoload.php";
use Models\BuyItem;
use Models\Buys;
use Models\Device;
use Models\Group;
use Models\Image;


$view = "";
if (isset($_GET["view"]))
    $view = $_GET["view"];
/*
controls the RESTful services
URL mapping for all urls
*/

function setHttpHeaders($contentType, $statusCode)
{
    $statusMessage = getHttpStatusMessage($statusCode);

    header('HTTP/1.1' . " " . $statusCode . " " . $statusMessage);
    header("Content-Type:" . $contentType); // . is concatenation in php

}

function getHttpStatusMessage($statusCode)
{
    $httpStatus = array(
        100 => 'Continue', 101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported');

    return ($httpStatus[$statusCode]) ? $httpStatus[$statusCode] : $httpStatus[500];
}


$authToken = Util::getAuthToken(apache_request_headers());;

if ($authToken == null)
    die(401);

$data = $authToken['data'];
$userId = $data->userId;

switch ($view) {

    /*all routing for device*/

    case 'registerDevice':
        $inputJSON = file_get_contents('php://input');
        if ($inputJSON != null) {

            $device = Device::fromJSON($inputJSON);

            DeviceController::getInstance()->registerDevice($device, $userId);

        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        break;
    case 'sendGcm':
        TestRestHandler::getInstance()->SendNotification($userId);
        break;

    /*all routing for buyItems*/

    case 'saveBuyItems':

        if (isset($_POST['buyItem']) && isset($_POST['buyItem'])) {

            $buyitems = BuyItem::fromJSON($_POST['buyItem']);
            BuyItemsController::getInstance()->saveBuyItems($buyitems, $_POST['buyItem']);
            
        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        break;

    case 'loadBuyItems':

        BuyItemsController::getInstance()->loadBuyItems($userId);
        break;

    case 'updateBuyItemPrice':

        if (isset($_GET['buyItemId']) && isset($_GET['price']))
            BuyItemsController::getInstance()->updateBuyItemPrice($_GET['buyItemId'], $_GET['price']);
        else
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
        break;

    /*all routing for Buys*/

    case 'saveBuys':
        $inputJSON = file_get_contents('php://input');

        echo json_encode($inputJSON);
        if ($inputJSON != null) {
            $buys = Buys::fromJSON($inputJSON);
            BuysController::getInstance()->saveBuys($buys, $userId);
        } else
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);

        break;
    case 'loadBuys':
        BuysController::getInstance()->loadBuys($userId);
        break;
    case 'addReceiver':

        if (isset($_POST['buyId'])) {

            $buyId = $_POST['buyId'];
            BuysController::getInstance()->addReceiver($buyId, $userId);
        } else
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);

        break;
    case 'getReceiver':

        if (isset($_POST['buyId'])) {

            $buyId = $_POST['buyId'];
            BuysController::getInstance()->getReceiver($buyId);
        } else
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
        break;

    /*all routing for Event*/

    /*all routing for Group*/
    case 'createGroup':
        if (isset($_POST['groupName']) && isset($_POST['adminRole'])) {

            $group = new Group(0, $userId, $_POST['groupName']);

            GroupController::getInstance()->save($group, $_POST['adminRole']);


        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        break;
    case 'addMember' :

        if (!isset($_POST['groupId']) || !isset($_POST['memberId']) || !isset($_POST['Role'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }


        GroupController::getInstance()->addMember($_POST['groupId'], $_POST['memberId'], $_POST['Role']);
        break;

    case 'deleteMember' :

        if (!isset($_POST['groupId']) || !isset($_POST['userId'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        GroupController::getInstance()->deleteMember($_POST['groupId'], $_POST['userId']);
        break;
    case 'getgroupUser' :

        if (!isset($_GET['groupId'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        GroupController::getInstance()->GetGroupUser($_GET['groupId']);
        break;

    /*all routing for Image*/

    case 'saveImage':

        if (!isset($_POST['type'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }


        echo json_encode($_POST['type']);

        $fileName = $_FILES['picture']['name'];
        $tmpName = $_FILES['picture']['tmp_name'];
        $fileSize = $_FILES['picture']['size'];
        $fileType = $_FILES['picture']['type'];

        $distination = '/var/www/html/FamilyPlus/upload/';

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = $userId . date('Y-m-d-g-i-s') . '.' . $ext;
        move_uploaded_file($tmpName, $distination . '/' . $fileName);


        $image = new Image($fileName, $fileType, $fileSize, $_POST['type']);

        ImageController::getInstance()->save($image, $userId);

        break;

    case "getImageById":

        if (!isset($_GET['id'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }


        ImageController::getInstance()->getImageById($_GET['id']);

        break;

    case "getImagesByUser":

        if (!isset($_GET['type'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }

        ImageController::getInstance()->getImages($userId, $_GET['type']);
        break;

    case "deleteImage":

        // this method is not implemented yet
        if (!isset($_GET['type'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }

        ImageController::getInstance()->delete($userId, $_GET['type']);
        break;

    case "getImageByUserId":

        if (!isset($_GET['userId']) || !isset($_GET['type'])) {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }

        ImageController::getInstance()->getImages($_GET['userId'], $_GET['type']);

        break;
}
