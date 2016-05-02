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
     * @return boolean return status of saving.
     */
    public function save(BuyItem $buyItem , $userId)
    {
        $sql = 'INSERT INTO ' . DBCons::$_BUYITEMS_TABLE .
            ' (' . DBCons::$_BUYITEMS_M_NUMBER .
            ' , '. DBCons::$_BUYITEMS_NAME .
            ' , '. DBCons::$_BUYITEMS_PURCHASED .
            ' , '. DBCons::$_BUYITEMS_PRICE .
            ' , '. DBCons::$_BUYITEMS_DATE .') VALUES (?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('dsidi' , $userId , $buyItem->getName() , $buyItem->getPurchased()
                                ,$buyItem->getPrice() , $buyItem->getDate());

        $result = $statement->execute();
        $statement->close();
        return $result;
    }


    public function loadbyUser($userId)
    {
        $sql = ' SELECT * FROM ' .DBCons::$_BUYITEMS_TABLE .
            ' WHERE ' . DBCons::$_BUYITEMS_M_NUMBER .'= ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d' , $userId);
        $statement->execute();

        $statement->bind_result($id , $m_nimber , $name , $purchased , $price , $date);
        if($statement->fetch())
        {
            $statement->close();
            return new BuyItem($name , $purchased , $price , $date);
        }else
        {
            $statement->close();
            return null;
        }
    }

    public function loadbyDate($date)
    {
        $sql = ' SELECT * FROM ' .DBCons::$_BUYITEMS_TABLE .
            ' WHERE ' . DBCons::$_BUYITEMS_DATE .'= ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i' , $date);
        $statement->execute();

        $statement->bind_result($id , $m_nimber , $name , $purchased , $price , $date);
        if($statement->fetch())
        {
            $statement->close();
            return new BuyItem($name , $purchased , $price , $date);
        }else
        {
            $statement->close();
            return null;
        }
    }
}