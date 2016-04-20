<?php

include_once 'GroupDAO.php';
include_once '../Models/Group.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/20/16
 * Time: 10:20 AM
 */
class GroupDAOMS implements GroupDAO
{
    private $_connection;

    /**
     * GroupDAOMS constructor.
     * @param $_connection : database connection.
     */
    public function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }


    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return array: all groups that user is member in them.
     */
    public function loadByUserId($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_GROUP_TABLE .
            ' WHERE ' . DBCons::$_GROUP_COL_ID .
            ' IN (SELECT ' . DBCons::$_GU_COL_GROUP_ID .
            ' FROM ' . DBCons::$_GU_TABLE . ' WHERE ' . DBCons::$_GU_COL_USER_ID . ' = ?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);

        $statement->bind_result($id, $admin, $name);
        $statement->execute();

        $groups = array();
        $groups[0] = 'now groups available';

        $i = 0;
        while ($statement->fetch()) {
            $groups[$i] = new Group($id, $admin, $name);
            $i++;
        }

        $statement->close();

        return $groups;
    }
}