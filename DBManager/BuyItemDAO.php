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
     * @param $buyId : id of buy that this item is for him.
     * @return bool return status of saving.
     */
    public function save(BuyItem $buyItem, $buyId);

    /**
     * @param int $buyId : id of buy that item is for it.
     * @return array : of BuyItem;
     */
    public function loadByBuy($buyId);

    /**
     * @param int $buyItemId : id of buyItem.
     * @param int $price : new price.
     * @return bool          : status of update.
     */
    public function updatePrice($buyItemId, $price);

    /**
     * delete buyItem with id.
     * @param int $buyItemId : id of buyItem
     * @return boolean:
     */
    public function delete($buyItemId);
    
}