<?php
namespace DBManager;

use Models\BuyItem;
use mysqli;

require "../vendor/autoload.php";

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:43 PM
 */
class BuyItemDAOMS implements BuyItemDAO
{
    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    /**
     * @param BuyItem $buyItem will save in db
     * @param int $buyId : id of buy that item is for it.
     * @return bool return status of saving.
     */
    public function save(BuyItem $buyItem, $buyId)
    {

        $sql = 'INSERT INTO ' . DBCons::$_BUYITEMS_TABLE
            . ' (' . DBCons::$_BUYITEMS_NAME
            . ', ' . DBCons::$_BUYITEMS_PURCHASED
            . ', ' . DBCons::$_BUYITEMS_PRICE
            . ', ' . DBCons::$_BUYITEMS_QNTY
            . ', ' . DBCons::$_BUYITEMS_BUY_ID
            . ') VALUES (?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('siiii', $buyItem->getName(), $buyItem->getPurchased()
            , $buyItem->getPrice(), $buyItem->getQunty(), $buyId);

        $res = $statement->execute();
        $statement->close();

        return $res;

    }

    /**
     * @param int $buyItemId
     * @param int $price
     * @return bool
     */
    public function updatePrice($buyItemId, $price)
    {
        $sql = 'UPDATE ' . DBCons::$_BUYITEMS_TABLE
            . ' SET ' . DBCons::$_BUYITEMS_PRICE
            . '= ? WHERE ' . DBCons::$_BUYITEMS_COL_ID . '= ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('di', $price, $buyItemId);

        $res = $statement->execute();
        $statement->close();

        return $res;
    }

    /**
     * @param int $buyId : id of buy that item is for it.
     * @return array : of BuyItem;
     */
    public function loadByBuy($buyId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_BUYITEMS_TABLE
            . ' WHERE ' . DBCons::$_BUYITEMS_BUY_ID . '=?';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('i', $buyId);
        $statement->bind_result($id, $name, $purchased, $price, $quty, $buyId);
        $statement->execute();

        $i = 0;
        $items = array();

        while ($statement->fetch()) {
            $items[$i] = new BuyItem($id, $name, $purchased, $price, $quty);
            $i++;
        }

        return $items;
    }
}