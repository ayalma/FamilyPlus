<?php
include_once 'UserDAO.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:52 AM
 */
class UserDAOMS implements UserDAO
{
    private $_connection;

    function __construct($_connection)
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
            ',' . DBCons::$_USER_COL_FNAME . ') Values (?,?)';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('ds', $user->getMNumber(), $user->getFName());

        return $statement->execute();
    }
}