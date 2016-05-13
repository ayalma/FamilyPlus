<?php
namespace DBManager;
require "../vendor/autoload.php";

use Exception;
use Models\BuyItem;
use Models\Device;
use Models\EventType;
use Models\Group;
use Models\Image;
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
    private $_groupDao;
    private $_imageDao;

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
            $this->_groupDao = new GroupDAOMS($this->_connection);
            $this->_imageDao = new ImageDAOMS($this->_connection);

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

    public function loadUserRegIds($userId, $serial)
    {
        return $this->_deviceDao->loadRegIds($userId, $serial);
    }
    /**
     * all method related to User Model.
     */

    /**
     * @param User $user will save in database.
     * @return boolean status of saving as boolean.
     */
    public function saveUser(User $user)
    {
        return $this->_userDao->save($user);
    }

    public function updateUserName($userId, $userName)
    {
        return $this->_userDao->updateName($userId, $userName);
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
     * change
     * @param $userId : id of user (it is him/his phone number).
     * @return  array : all role of user in his groups peerTopPeer.
     */
    public function getRoles($userId)
    {
        return null;
    }


    /**
     * all method related to  Image.
     */


    /**
     * @param Image $image
     * @param $userId
     * @return bool
     */
    public function saveImage(Image $image, $userId)
    {
        return $this->_imageDao->save($image, $userId);
    }


    /**
     * @param $userId
     * @param $type : type of image
     * @return Image|null
     */
    public function loadImage($userId, $type)
    {
        return $this->_imageDao->load($userId, $type);
    }

    /**
     * @param $imageId
     * @return Image|null
     */
    public function loadImageById($imageId)
    {
        return $this->_imageDao->loadById($imageId);
    }

    public function deleteImage($userId, $type)
    {
        return $this->_imageDao->delete($userId, $type);
    }

    public function deleteImageById($imageId)
    {
        return $this->_imageDao->deleteById($imageId);
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
     * @param LoginCode $loginCode e loginCode will save database.
     * @return bool status of saving .
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

    /**
     * @param BuyItem $item will save in database.
     * @param $userId : of user that id belong to him/his.
     * @return bool status of saving.
     */
    public function saveItems(BuyItem $item , $userId)
    {
        return $this->_buyItemDao->save( $item , $userId);
    }

    /**
     * all method related to group.
     */
    
    /**
     * @param Group $group : group to save.
     * @return int         : id of group
     */
    public function saveGroup(Group $group)
    {
        return $this->_groupDao->save($group);
    }

    /**
     * @param $groupId : id of group.
     * @param $userId : id of group.
     * @param $role : role of user in this group.
     * @return boolean : status of adding as boolean.
     */
    public function saveMember($groupId, $userId, $role)
    {
        return $this->_groupDao->saveMember($groupId , $userId , $role);
    }

    /**
     * @param $groupId : id of group.
     * @param $userId : id of user.
     * @return boolean : status of removing.
     */
    public function deleteMember($groupId, $userId)
    {
        return $this->_groupDao->deleteMember($groupId, $userId);
    }

    /**
     * @param $groupId : id of group.
     * @return array: all users in this group
     */
    public function getGroupUsers($groupId)
    {
        return $this->_groupDao->loadGroupUser($groupId);
    }

}