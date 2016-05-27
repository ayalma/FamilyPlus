<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 2:31 PM
 */

namespace DBManager;


use Models\SystemMessage;
use mysqli;

class SystemMessageDAOMS implements SystemMessageDAO
{

    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    /**
     * @param SystemMessage $sysMsg : message to save
     * @param $userId : user that message is for him/his.
     * @return bool : status of saving.
     */
    public function save(SystemMessage $sysMsg, $userId)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param $smId : id of system message
     * @return SystemMessage : message with requested id.
     */
    public function loadById($smId)
    {
        // TODO: Implement loadById() method.
    }

    /**
     * @param $userId : id of user.
     * @return array : load all SystemMessage for user.
     */
    public function load($userId)
    {
        // TODO: Implement load() method.
    }

    /**
     * @param $smId : id of System message.
     * @return boolean : status of deleting.
     */
    public function delete($smId)
    {
        // TODO: Implement delete() method.
    }
}