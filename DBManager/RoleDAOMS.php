<?php

include_once '../Models/Role.php';
include_once 'RoleDAO.php';
include_once 'DBCons.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:45 PM
 */
class RoleDAOMS implements RoleDAO
{

    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return  array : all role of user in his groups peerTopPeer.
     */
    public function loadByUserID($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_GU_TABLE .
            ' WHERE ' . DBCons::$_GU_COL_USER_ID . '= ?';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('d', $userId);
        $statement->execute();

        $statement->bind_result($groupId, $userId, $role);

        $roles = array();
        $roles[0] = new Role(0, 0);

        $i = 0;
        while ($statement->fetch()) {
            $roles[$i] = new Role($role, $groupId);
            $i++;
        }
        $statement->close();

        return $roles;
    }

}