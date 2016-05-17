<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/17/16
 * Time: 3:22 PM
 */

namespace Controllers;


use DBManager\DbManager;

class BuysController
{
    private static $_instance = null;

    /**
     * BuyItemsController constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new BuysController();
        }
        return self::$_instance;
    }

    /**
     * @param $buys : buys object .
     * @param $userId : id of user.
     * @return bool : status of saving.
     */
    public function saveBuys($buys, $userId)
    {
        $response['save'] = DbManager::getInstance()->saveBuys($buys, $userId);
        echo json_encode($response);
    }

    /**
     * @param $userId : user id .
     * @return array : array of buys item.
     */
    public function loadBuys($userId)
    {
        $buys = DbManager::getInstance()->loadBuys($userId);
        echo json_encode($buys);
    }

    /**
     * @param int $buyId : id of buy.
     * @param int $userId : id of user.
     * @return bool : status of saving.
     */
    public function addReceiver($buyId, $userId)
    {
        $response['save'] = DbManager::getInstance()->addReceiver($buyId, $userId);
        echo json_encode($response);
    }

    /**
     * @param $buyId : id of buy .
     * @return array : user who access to this buy.
     */
    public function getReceiver($buyId)
    {
        $users = DbManager::getInstance()->getReceiver($buyId);
        echo json_encode($users);
    }

}