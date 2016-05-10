<?php
namespace DBManager;
require "../vendor/autoload.php";

use Models\BuyItem;


/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:43 PM
 */
interface BuyItemDAO
{
    /**
     * @param BuyItem $buyItem will save in db
     * @return boolean return status of saving.
     */
    public function save(BuyItem $buyItem, $userId);

    public function loadbyUser($userId);

    public function loadbyDate($date);
    
}