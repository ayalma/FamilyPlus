<?php
include_once 'LoGinCodeDAO.php.php';

/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/19/2016
 * Time: 7:46 PM
 */
class LoginCodeDAOMS implements LoGinCodeDAO
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
        $sql = 'INSERT INTO ' . DBCons::$_LOGINCODE_TABLE .
            ' (' . DBCons::$_LOGINCODE_COL_USER_ID .
            ',' . DBCons::$_LOGINCODE_COL_CODE . ') VALUES (?,?)';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('di' , $user->getMNumber() ,$user->getMNumber());
        return $statement->execute();
     }

    /**
     * @param $userId : id of requested user.
     * @return user that contains requested userId.
     */
    public function load($userId)
    {
        // TODO: Implement load() method.
    }
}