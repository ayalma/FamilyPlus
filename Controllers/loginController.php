<?php
require_once '../DBManager/DbManager.php';
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/17/16
 * Time: 1:24 PM
 */

$dbManager = DbManager::getInstance();

$response["tag"] = $_POST['tag'];
$response["login"] = $dbManager->save();

echo json_encode($response);
        
        



