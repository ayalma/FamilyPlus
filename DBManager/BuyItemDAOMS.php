<?php
include_once 'BuyItemDAO.php';
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
     * @return boolean return status of saving.
     */
    public function save(BuyItem $buyItem , $userId)
    {
        $sql = 'INSERT INTO ' . DBCons::$_LOGINCODE_TABLE .
            ' (' . DBCons::$_BUYITEMS_M_NUMBER .
            ' , '. DBCons::$_BUYITEMS_NAME .
            ' , '. DBCons::$_BUYITEMS_PURCHASED .
            ' , '. DBCons::$_BUYITEMS_PRICE .
            ' , '. DBCons::$_BUYITEMS_DATE .') VALUES (?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);
        return ;
    }

    public function load($buyItem)
    {
        // TODO: Implement load() method.
    }
}