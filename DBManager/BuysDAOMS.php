<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/17/16
 * Time: 12:31 PM
 */

namespace DBManager;


use Models\Buys;
use Models\User;
use mysqli;

class BuysDAOMS implements BuysDAO
{

    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    /**
     * @param Buys $buys buyItem for save
     * @param $userId : id of user.
     * @return bool
     */
    public function save(Buys $buys, $userId)
    {
        $sql = 'INSERT INTO '
            . DBCons::$_BUY_TABLE
            . ' (' . DBCons::$_BUY_COL_TITLE
            . ', ' . DBCons::$_BUY_COL_DATE
            . ', ' . DBCons::$_BUY_COL_OWNER
            . ') VALUES (?,?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('sid', $buys->getTitle(), $buys->getDate(), $userId);

        $res = $statement->execute();
        $buyId = $statement->insert_id;
        $statement->close();
        if ($buys->getBuyItems() != null && sizeof($buys->getBuyItems()) > 0 && $buys->getBuyItems() != null)
            $res &= DbManager::getInstance()->saveBuyItems($buys->getBuyItems()[0], $buyId);

        return $res;
    }

    /**
     * @param $userId : id of user.
     * @return array  : users Buys .
     */
    public function load($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_BUY_TABLE
            . ' WHERE ' . DBCons::$_BUY_COL_OWNER . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);
        $statement->bind_result($id, $title, $date, $owner);
        $statement->execute();
        $statement->store_result();

        $i = 0;
        $buys = array();

        while ($statement->fetch()) {
            $buys[$i] = new Buys($id, $title, $date, $this->getReceiver($id), DbManager::getInstance()->loadBuyItems($id), DbManager::getInstance()->loadUser($owner));
            $i++;
        }

        $statement->close();
        return $buys;
    }

    /**
     * @param $buyId : id of buy .
     * @return array : user who access to this buy.
     */
    public function getReceiver($buyId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_USER_TABLE
            . ' WHERE ' . DBCons::$_USER_COL_MOBILE_NUMBER
            . ' = (SELECT ' . DBCons::$_BU_COL_USER_ID
            . ' FROM ' . DBCons::$_BU_TABLE
            . ' WHERE ' . DBCons::$_BU_COL_BUY_ITEM_ID . ' =?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $buyId);
        $statement->bind_result($fName, $mobileNumber);

        $i = 0;
        $users = array();

        while ($statement->fetch()) {
            $users[$i] = new User($fName, $mobileNumber);
            $i++;
        }

        $statement->close();
        return $users;
    }

    /**
     * @param int $buyId : id of buy.
     * @param int $userId : id of user.
     * @return bool : status of saving.
     */
    public function addReceiver($buyId, $userId)
    {
        $sql = 'INSERT INTO ' . DBCons::$_BU_TABLE
            . ' (' . DBCons::$_BU_COL_BUY_ITEM_ID
            . ', ' . DBCons::$_BU_COL_USER_ID . ') VALUES (?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('id', $buyId, $userId);

        $res = $statement->execute();
        $statement->close();

        return $res;
    }

    /**
     * @param $userId : id of user.
     * @return array  : buys shared with user.
     */
    public function loadSharedBuys($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_BUY_TABLE
            . ' WHERE ' . DBCons::$_BUY_COL_ID
            . ' IN (SELECT ' . DBCons::$_BU_COL_BUY_ITEM_ID
            . ' FROM ' . DBCons::$_BU_TABLE . ' WHERE '
            . DBCons::$_BU_COL_USER_ID . ' = ?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);
        $statement->bind_result($id, $title, $date, $owner);
        $statement->execute();
        $statement->store_result();

        $i = 0;
        $buys = array();

        while ($statement->fetch()) {
            $buys[$i] = new Buys($id, $title, $date, $this->getReceiver($id), DbManager::getInstance()->loadBuyItems($id), DbManager::getInstance()->loadUser($owner));
            $i++;
        }

        $statement->close();
        return $buys;

    }


    /**
     * @param $Id : id of buy .
     * @return bool :
     */
    public function delet($Id)
    {
        $sql = 'DELETE FROM ' . DBCons::$_BUY_TABLE
            . ' WHERE ' . DBCons::$_BUY_COL_ID .'= ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $Id);
        $res = $statement->execute();

        $statement->close();
        return $res;
    }
}