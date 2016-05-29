<?php
namespace DBManager;
require "../vendor/autoload.php";

use Models\Group;
use Models\User;
use mysqli;

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
        $statement->store_result();

        $groups = array();
        $groups[0] = 'now groups available';

        $i = 0;
        while ($statement->fetch()) {
            $groups[$i] = new Group($id, DbManager::getInstance()->loadUser($admin), $name);
            $i++;
        }

        $statement->close();

        return $groups;
    }

    /**
     * @param Group $group : group to save.
     * @return Group
     */
    public function save(Group $group)
    {
        $sql = 'INSERT INTO ' . DBCons::$_GROUP_TABLE
            . ' (' . DBCons::$_GROUP_COL_ADMIN
            . ', ' . DBCons::$_GROUP_COL_NAME . ') VALUES (?,?)';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('ds', $group->getAdmin()->getMNumber(), $group->getName());
        if ($statement->execute()) {
            $group->setId($statement->insert_id);
            $statement->close();
            return $group;
        }
        $statement->close();
        return null;

    }

    /**
     * @param $groupId : id of group.
     * @param $userId : id of group.
     * @param $role : role of user in this group.
     * @return boolean : status of adding as boolean.
     */
    public function saveMember($groupId, $userId, $role)
    {
        $sql = 'INSERT INTO ' . DBCons::$_GU_TABLE
            . ' (' . DBCons::$_GU_COL_GROUP_ID
            . ', ' . DBCons::$_GU_COL_USER_ID
            . ', ' . DBCons::$_GU_COL_ROlE . ') VALUES (?,?,?)';
        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('idi', $groupId, $userId, $role);

        $res = $statement->execute();

        $statement->close();

        return $res;
    }


    /**
     * @param $groupId : id of group.
     * @param $userId : id of user.
     * @return boolean : status of removing.
     */
    public function deleteMember($groupId, $userId)
    {
        $sql = 'DELETE FROM ' . DBCons::$_GU_TABLE
            . ' WHERE ' . DBCons::$_GU_COL_GROUP_ID
            . ' = ? AND ' . DBCons::$_GU_COL_USER_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('id', $groupId, $userId);
        $res = $statement->execute();

        $statement->close();
        return $res;

    }

    /**
     * @param $groupId : id of group.
     * @return array: all users in this group
     */
    public function loadGroupUser($groupId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_USER_TABLE
            . ' WHERE ' . DBCons::$_USER_COL_MOBILE_NUMBER
            . ' IN (SELECT ' . DBCons::$_GU_COL_USER_ID
            . ' FROM ' . DBCons::$_GU_TABLE
            . ' WHERE ' . DBCons::$_GU_COL_GROUP_ID . ' = ?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $groupId);

        $statement->bind_result($fname, $m_number);
        $statement->execute();
        $statement->store_result();

        $user = array();
        $user[0] = 'no user available';

        $i = 0;
        while ($statement->fetch()) {
            $tempUser = new User($fname, $m_number);

            $tempUser->setRoles(DbManager::getInstance()->loadUserRolesByGroupId($tempUser->getMNumber(), $groupId));
            $user[$i] = $tempUser;
            $i++;
        }

        $statement->close();

        return $user;

    }

    /**
     * method for checking that user has membership in any group.
     * @param $userId : id of user.
     * @return boolean : true if user be member of any group.
     */
    public function haveAGroup($userId)
    {
        $sql = 'SELECT ' . DBCons::$_GU_COL_GROUP_ID
            . ' FROM ' . DBCons::$_GU_TABLE
            . ' WHERE ' . DBCons::$_GU_COL_USER_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);
        $statement->bind_result($groupId);

        $statement->execute();


        if ($statement->fetch()) {
            // if at least one group exist for user.
            $statement->close();
            return true;
        }

        // if there is no group in db
        $statement->close();
        return false;
    }

    /**
     * method for loading user group.
     * @param $userId : id of user.
     * @return Group|null: return Group of user or null.
     */
    public function loadGroup($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_GROUP_TABLE
            . ' WHERE ' . DBCons::$_GROUP_COL_ID
            . ' = (SELECT ' . DBCons::$_GU_COL_GROUP_ID
            . ' FROM ' . DBCons::$_GU_TABLE
            . ' WHERE ' . DBCons::$_GU_COL_USER_ID . ' =?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);
        $statement->bind_result($groupId, $adminId, $groupName);

        $statement->execute();
        $statement->store_result();


        if ($statement->fetch()) {
            $group = new Group($groupId, DbManager::getInstance()->loadUser($adminId), $groupName);
            $statement->close();
            return $group;
        }

        // if there is no group in db
        $statement->close();
        return null;

    }
}