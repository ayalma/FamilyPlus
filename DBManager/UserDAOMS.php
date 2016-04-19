<?php
include_once 'UserDAO.php';
include_once '../Models/Role.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:52 AM
 */
class UserDAOMS implements UserDAO
{
    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }


    /**
     * @param User $user user will be save in data base.
     * @return mixed status of saving as boolean.
     */
    public function save(User $user)
    {
        $sql = 'INSERT INTO ' . DBCons::$_USER_TABLE .
            ' (' . DBCons::$_USER_COL_MOBILE_NUMBER .
            ',' . DBCons::$_USER_COL_FNAME . ') VALUES (?,?)';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('ds', $user->getMNumber(), $user->getFName());

        return $statement->execute();
    }

    /**
     * @param $userId : id of requested user.
     * @return user that contains requested userId or null if userId dose't match .
     */
    public function load($userId)
    {
        $sql = 'Select ' . DBCons::$_USER_COL_FNAME . ' from ' . DBCons::$_USER_TABLE .
            ' Where ' . DBCons::$_USER_COL_MOBILE_NUMBER . '= ? ';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);

        $statement->execute();
        $statement->bind_result($fname);

        if ($statement->fetch()) {

            $statement->close();
            return new User($fname, $userId);

        } else {
            $statement->close();
            return 'no user found';
        }
    }

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return  array : all role of user in his groups peerTopPeer.
     */
    public function getRoles($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_GU_TABLE .
            ' WHERE ' . DBCons::$_GU_USER_ID . '= ?';

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

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return array: all groups that user is member in them.
     */
    public function getGroups($userId)
    {
        // TODO: Implement getGroups() method.
    }

    /**
     * @param $userId : id of user (it is him/his phone number)
     * @return array: all buyItems belong to user.
     */
    public function getBuyItems($userId)
    {
        // TODO: Implement getBuyItems() method.
    }
}