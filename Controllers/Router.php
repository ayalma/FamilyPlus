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
use Firebase\JWT\JWT;
use JsonMapper;
use Models\Device;


$view = "";
if (isset($_GET["view"]))
    $view = $_GET["view"];
/*
controls the RESTful services
URL mapping for all urls
*/

$userId = '';
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

if (!isset(apache_request_headers()['Authorization'])) {
    setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
    die(400);
} else {
    try {
        $acessToken = apache_request_headers()['Authorization'];
        $token = JWT::decode($acessToken, 'sampleKey', array('HS512'));
        $token = (array)$token;
        $userId = ($token['data']['userId']);

    } catch (\Exception $e) {

        setHttpHeaders($_SERVER['HTTP_ACCEPT'], 401);
        die(401);

    }
}

switch ($view) {
    case 'registerDevice':

        if (isset($_POST['device'])) {

            $mapper = new JsonMapper();
            $device = $mapper->map($_POST['device'], new Device());
            DeviceController::getInstance()->registerDevice($device, $userId);

        } else {
            setHttpHeaders($_SERVER['HTTP_ACCEPT'], 400);
            break;
        }
        break;
}
