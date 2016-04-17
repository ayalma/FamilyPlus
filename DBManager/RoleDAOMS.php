<?php

include_once 'RoleDAO.php';

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:45 PM
 */
class RoleDAOMS implements RoleDAO
{

    private $_connection;

    function __construct($_connection)
    {
        $this->_connection = $_connection;
    }
}