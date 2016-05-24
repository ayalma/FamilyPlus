<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/2/2016
 * Time: 11:46 AM
 */

namespace Controllers;

use DBManager\DbManager;
use Models\BuyItem;

class BuyItemsController
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
            self::$_instance = new BuyItemsController();
        }
        return self::$_instance;
    }

    public function saveBuyItems(BuyItem $item, $buyId)
    {
        $response['save'] = DbManager::getInstance()->saveBuyItems($item, $buyId);
        echo json_encode($response);
    }

    public function loadBuyItems($userId)
    {
        $buyitems = DbManager::getInstance()->loadBuyItems($userId);

        echo json_encode($buyitems);
    }

    public function updateBuyItemPrice($buyItemId, $price)
    {
        $response['update'] = DbManager::getInstance()->updateItemPrice($buyItemId, $price);
        echo json_encode($response);
    }

    public function delete($buyItemId)
    {
        $response['delete'] = DbManager::getInstance()->deleteBuyItem($buyItemId);
        echo json_encode($response);
    }

}