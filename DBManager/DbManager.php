<?php

include_once 'DBCons.php';

include_once 'UserDAOMS.php';
include_once 'BuyItemDAOMS.php';
include_once 'EventsDAOMS.php';
include_once 'RoleDAOMS.php';
include_once 'UserDAOMS.php';
include_once 'DeviceDAOMS.php';


/**
 * DbManager class that list all method that access to database.
 * this class also implement singleton pattern.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:38 AM
 */
class DbManager
{

    private static $_instance = null;
    private $_connection;
    private $_userDao;
    private $_buyItemDao;
    private $_eventsDao;
    private $_roleDao;
    private $_deviceDao;

    function __construct()
    {
        try {

            $this->_connection = mysqli_connect(DBCons::$_host, DBCons::$_user, DBCons::$_password, DBCons::$db_name);

            if (!$this->_connection) {

            }

            $this->_userDao = new UserDAOMS($this->_connection);
            $this->_buyItemDao = new BuyItemDAOMS($this->_connection);
            $this->_eventsDao = new EventsDAOMS($this->_connection);
            $this->_roleDao = new RoleDAOMS($this->_connection);
            $this->_deviceDao = new DeviceDAOMS($this->_connection);


        } catch (Exception $_e) {
            error_log($_e->getMessage());
        }
    }

    static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new DbManager();

        return self::$_instance;
    }

    /**
     * all method related to Device Model.
     */

    /**
     * @param Device $device will save in database.
     * @param $userId : of user that device belong to him/his.
     * @return bool status of saving.
     */
    public function save(Device $device, $userId)
    {
        return $this->_deviceDao->save($device, $userId);
    }

    /**
     * all method related to User Model.
     * @param User $user will save in database.
     * @return mixed status of saving as boolean.
     */
    public function saveUser(User $user)
    {
        return $this->_userDao->save($user);
    }

    /**
     * @param $userId : id of user must be load from db.
     * @return user : user or null if id don't match.
     */
    public function getUser($userId)
    {
        return $this->_userDao->load($userId);
    }

}