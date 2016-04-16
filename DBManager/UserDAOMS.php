<?php

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
        // TODO: Implement save() method.
    }
}