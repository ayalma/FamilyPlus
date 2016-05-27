<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 2:31 PM
 */

namespace DBManager;


use Models\SystemMessage;
use mysqli;

class SystemMessageDAOMS implements SystemMessageDAO
{

    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    /**
     * @param SystemMessage $sysMsg : message to save
     * @param $userId : user that message is for him/his.
     * @return bool : status of saving.
     */
    public function save(SystemMessage $sysMsg, $userId)
    {
        $sql = 'INSERT INTO ' . DBCons::$_SYS_MSG_TABLE
            . ' (' . DBCons::$_SYS_MSG_COL_USER_ID
            . ', ' . DBCons::$_SYS_MSG_COL_MSG
            . ') VALUES (?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('ds',$sysMsg->getUid(),$sysMsg->getMessage());
        $res = $statement->execute();
        $statement->close();

        return $res;
    }

    /**
     * @param $smId : id of system message
     * @return SystemMessage : message with requested id.
     */
    public function loadById($smId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_SYS_MSG_TABLE
            . ' WHERE ' . DBCons::$_SYS_MSG_COL_ID . '=?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $smId);
        $statement->bind_result($userId,$message,$smId);
        $statement->execute();

        if($statement->fetch())
        {
            $statement->close();
            return new SystemMessage($smId,$userId,$message);
        }
        else
        {
            $statement->close();
            return null;
        }
    }

    /**
     * @param $userId : id of user.
     * @return array : load all SystemMessage for user.
     */
    public function load($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_SYS_MSG_TABLE
            . ' WHERE ' . DBCons::$_SYS_MSG_COL_USER_ID . '=?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d',$userId);
        $statement->bind_result($id,$message,$userId);
        $statement->execute();

        $i = 0;
        $items = array();

        while ($statement->fetch())
        {
            $items[$i] = new SystemMessage($id ,$userId,$message);
            $i++;
        }

        return $items;
    }

    /**
     * @param $smId : id of System message.
     * @return boolean : status of deleting.
     */
    public function delete($smId)
    {
        $sql = 'DELETE FROM ' . DBCons::$_SYS_MSG_TABLE
            . ' WHERE ' . DBCons::$_SYS_MSG_COL_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $smId);

        $res = $statement->execute();
        $statement->close();
        return $res;
    }
}