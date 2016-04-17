<?php
include_once 'BuyItemDAO.php';
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 12:43 PM
 */
class BuyItemDAOMS implements BuyItemDAO
{
    private $_connection;

    function __construct($_connection)
    {
        $this->_connection = $_connection;
    }

}