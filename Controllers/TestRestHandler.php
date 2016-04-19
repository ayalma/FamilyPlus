<?php
include_once 'SimpleRest.php';
require_once '../DBManager/DbManager.php';
include_once '../Models/User.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/19/16
 * Time: 11:36 AM
 */
class TestRestHandler extends SimpleRest
{

    private static $_instance = null;

    /**
     * TestRestHandler constructor.
     */
    public function __construct()
    {
    }


    public static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new TestRestHandler();
        return self::$_instance;
    }

    public function getUser($userId)
    {
        $user = User::fromJSON('{"fName":"ali","mNumber":"12"}');
        // $user = DbManager::getInstance()->getUser($userId);

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $respons['userId'] = $userId;
        $respons['fname'] = $user->getFName();
        $respons['user'] = $user;

        echo json_encode($respons);
    }

    public function getRoles($userId)
    {
        $roles = DbManager::getInstance()->getRoles($userId);

        $statusCode = 200;
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        $respons['roles'] = json_encode($roles);

        echo json_encode($respons);
    }

}