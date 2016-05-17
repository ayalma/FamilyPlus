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
     * @param $userId : id of user
     * @return bool return status of saving.
     */
    public function save(BuyItem $buyItem, $userId)
    {

        $titleId = $this->saveOrGetTitle($buyItem->getTitle());

        $sql = 'INSERT INTO ' . DBCons::$_BUYITEMS_TABLE .
            ' (' . DBCons::$_BUYITEMS_M_NUMBER .
            ' , ' . DBCons::$_BUYITEMS_NAME .
            ' , ' . DBCons::$_BUYITEMS_PURCHASED .
            ' , ' . DBCons::$_BUYITEMS_PRICE .
            ' , ' . DBCons::$_BUYITEMS_DATE .
            ' , ' . DBCons::$_BUYITEMS_QNTY .
            ' , ' . DBCons::$_BUYITEMS_ITEM_GROUP . ') VALUES (?,?,?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('dsidiii', $userId, $buyItem->getName(), $buyItem->getPurchased()
            , $buyItem->getPrice(), $buyItem->getDate(), $buyItem->getQunty(), $titleId);

        $result = $statement->execute();
        $buyitemId = $statement->insert_id;
        $res = false;
        if ($result) {

            foreach ($buyItem->getUsers() as $reciverUserId)
                $res = $this->saveReceiver($reciverUserId, $buyitemId);
        }
        return $res && $result;
    }

    private function saveOrGetTitle($title)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_BG_TABLE
            . ' WHERE ' . DBCons::$_BG_COL_TITLE . ' =?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('s', $title);

        $statement->execute();
        $statement->bind_result($id, $title);

        if (!$statement->fetch()) {
            //so i must save to dab and return id of title
            $statement->close();

            $sql = 'INSERT INTO ' . DBCons::$_BG_TABLE
                . ' (' . DBCons::$_BG_COL_TITLE . ') VALUES (?);';

            $statement = $this->_connection->prepare($sql);
            $statement->bind_param('s', $title);

            $statement->execute();

            $id = $statement->insert_id;
            $statement->close();

            return $id;
        } else {
            $statement->close();
            return $id;
        }


    }


    /**
     * @param int $userId id of user that event sent to him/his.
     * @param int $butItemId : id of item.
     * @return bool status of save.
     */
    private function saveReceiver($userId, $buyItemId)
    {
        $sql = 'INSERT INTO ' . DBCons::$_BIU_TABLE .
            ' (' . DBCons::$_BIU_COL_USER_ID .
            ' , ' . DBCons::$_BIU_COL_BUY_ITEM_ID . ') VALUES (?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('di', $userId, $buyItemId);

        $result = $statement->execute();
        $statement->close();
        return $result;
    }

    public function loadByUser($userId)
    {
        $sql = ' SELECT * FROM ' . DBCons::$_BUYITEMS_TABLE .
            ' WHERE ' . DBCons::$_BUYITEMS_M_NUMBER . '= ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);
        $statement->bind_result($id, $name, $purchased, $price, $date, $m_number, $qnty, $item_group);
        $statement->execute();

        $statement->store_result();

        $buyItems = array();
        $i = 0;

        while ($statement->fetch()) 
        {
            $title = $this->getTitle($item_group);
            $user = $this->loadReciver($id);

            $buyItems[$i] = new BuyItem($name, $purchased, $price, $date, $user, $qnty, $title);
            $i++;
        }
        $statement->close();

        return $buyItems;

    }

    private function getTitle($titleId)
    {
        $sql = 'SELECT ' . DBCons::$_BG_COL_TITLE .
            ' FROM ' . DBCons::$_BG_TABLE .
            ' WHERE ' . DBCons::$_BG_COL_ID . '=? ';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $titleId);
        $statement->bind_result($title);
        $statement->execute();

        if ($statement->fetch()) {
            $statement->close();
            return $title;
        } else {
            $statement->close();
            return null;
        }

    }

    private function loadReciver($BuyItemId)
    {
        $sql = 'SELECT ' . DBCons::$_BIU_COL_USER_ID .
            ' FROM ' . DBCons::$_BIU_TABLE .
            ' WHERE ' . DBCons::$_BIU_COL_BUY_ITEM_ID . '=?';

        $statement = $this->_connection->prepare($sql);
        if (false === $statement) {
            // and since all the following operations need a valid/ready statement object
            // it doesn't make sense to go on
            // you might want to use a more sophisticated mechanism than die()
            // but's it's only an example
            die('prepare() failed: ' . htmlspecialchars($this->_connection->error));
        }
        $statement->bind_param('i', $BuyItemId);

        $statement->execute();
        $statement->bind_result($userId);

        if ($statement->fetch()) {
            $statement->close();
            return $userId;
        } else {
            $statement->close();
            return null;
        }

    }

    public function loadByDate($date)
    {
        $sql = ' SELECT * FROM ' . DBCons::$_BUYITEMS_TABLE .
            ' WHERE ' . DBCons::$_BUYITEMS_DATE . '= ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $date);
        $statement->execute();

        $statement->bind_result($id, $m_nimber, $name, $purchased, $price, $date);
        if ($statement->fetch()) {
            $statement->close();
            return new BuyItem($name, $purchased, $price, $date);
        } else {
            $statement->close();
            return null;
        }
    }


}