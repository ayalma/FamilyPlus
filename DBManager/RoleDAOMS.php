<?php
namespace DBManager;

require "../vendor/autoload.php";
use Models\Role;
use mysqli;

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
            ' WHERE ' . DBCons::$_GU_COL_USER_ID . '=?';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('d', $userId);
        $statement->execute();

        $groupId = 0;
        $role = 0;
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

    public function loadByUserIdAndGroup($userId, $groupId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_GU_TABLE .
            ' WHERE ' . DBCons::$_GU_COL_USER_ID . '= ? AND '
            . DBCons::$_GU_COL_GROUP_ID . '=?';

        $statement = $this->_connection->prepare($sql);

        /*if ( false===$statement ) {
            // and since all the following operations need a valid/ready statement object
            // it doesn't make sense to go on
            // you might want to use a more sophisticated mechanism than die()
            // but's it's only an example
            die('prepare() failed: ' . htmlspecialchars($this->_connection->error));
        }*/

        $statement->bind_param('di', $userId, $groupId);
        $statement->execute();

        $statement->bind_result($groupId, $userId, $role);

        $roles = array();

        $i = 0;
        while ($statement->fetch()) {
            $roles[$i] = new Role($role, $groupId);
            $i++;
        }
        $statement->close();

        return $roles;
    }


}