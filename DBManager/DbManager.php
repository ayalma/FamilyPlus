<?php
namespace DBManger;
require "../vendor/autoload.php";

use Exception;
use Models\Device;
use Models\EventType;
use Models\LoginCode;
use Models\User;

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
    private $_loginCodeDao;
    private $_eventTypeDao;

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
            $this->_loginCodeDao = new LoginCodeDAOMS($this->_connection);
            $this->_eventTypeDao = new EventTypeDAOMS($this->_connection);

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
     */

    /**
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
    public function loadUser($userId)
    {
        return $this->_userDao->load($userId);
    }

    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return  array : all role of user in his groups peerTopPeer.
     */
    public function getRoles($userId)
    {
        return null;
    }


    /**
     * all method related to  EventType.
     */

    /**
     * @param $eventTypeId : id of eventType.
     * @return EventType: eventType contains requested id.
     */
    public function loadEventType($eventTypeId)
    {
        return $this->_eventTypeDao->loadByEventId($eventTypeId);
    }

    public function saveEventType(EventType $eventType)
    {
        return $this->_eventTypeDao->save($eventType);
    }

    /**
     * all method related to LoginCode.
     */

    /**
     * @param  LoginCode : $loginCode loginCode will save database.
     * @return boolean status of saving .
     */

    public function saveLoginCode(LoginCode $loginCode)
    {
        return $this->_loginCodeDao->save($loginCode);
    }

    /**
     * @param $userId : id of user loginCode belong to him.
     * @return LoginCode : last loginCode for requested userId.
     */
    public function loadLoginCode($userId)
    {
        return $this->_loginCodeDao->load($userId);
    }

}