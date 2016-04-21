<?php
namespace DBManger;
require "../vendor/autoload.php";

use Models\LoginCode;
use mysqli;

/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/19/2016
 * Time: 7:46 PM
 */
class LoginCodeDAOMS implements LoginCodeDAO
{

    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    /**
     * @param LoginCode $loginCode will be save in data base.
     * @return mixed status of saving as boolean.
     */
    public function save(LoginCode $loginCode)
    {
        $sql = 'INSERT INTO ' . DBCons::$_LOGINCODE_TABLE .
            ' (' . DBCons::$_LOGINCODE_COL_USER_ID .
            ',' . DBCons::$_LOGINCODE_COL_CODE .
            ',' . DBCons::$_LOGINCODE_COL_EXPIRED . ') VALUES (?,?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('dii', $loginCode->getUserId(), $loginCode->getCode(), intval($loginCode->getExpired()));

        $res = $statement->execute();
        $statement->close();

        return $res;
    }

    /**
     * @param $userId : id of user that loginCode belong to him/his.
     * @return LoginCode : last login code sent to user.
     */
    public function load($userId)
    {
        $sql = 'SELECT * FROM ' . DBCons::$_LOGINCODE_TABLE .
            ' WHERE ' . DBCons::$_LOGINCODE_COL_ID .
            ' = (SELECT max(' . DBCons::$_LOGINCODE_COL_ID .
            ') FROM ' . DBCons::$_LOGINCODE_TABLE . ' WHERE ' .
            DBCons::$_DEVICE_COL_USER_ID . '= ?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('d', $userId);
        $statement->execute();

        $statement->bind_result($id, $userId, $code, $expired);
        if ($statement->fetch()) {
            $statement->close();
            return new LoginCode($userId, $code, $expired);
        } else {
            $statement->close();
            return null;
        }


    }
}