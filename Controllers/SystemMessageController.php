<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/27/2016
 * Time: 9:05 PM
 */

namespace Controllers;

use DBManager\DbManager;
use Models\SystemMessage;


class SystemMessageController
{

    private static $_instance = null;

    /**
     * SystemMessageController constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new SystemMessageController();
        }
        return self::$_instance;
    }
    
    /**
     * @param $smId : id of system message
     * @return SystemMessage : message with requested id.
     */
    public function loadMessageById($smId)
    {
        $loadMessage = DbManager::getInstance()->loadSystemMessageById($smId);
        echo json_encode($loadMessage);
    }

    /**
     * @param $userId : id of user.
     * @return array : load all SystemMessage for user.
     */
    public function loadMessage($userId)
    {
        $loadMessage = DbManager::getInstance()->loadSystemMessage($userId);
        echo json_encode($loadMessage);
    }

    /**
     * @param $smId : id of System message.
     * @return boolean : status of deleting.
     */
    public function deleteMessage($smId)
    {
        $response['delete'] = DbManager::getInstance()->deleteSystemMessage($smId);
        echo json_encode($response);
    }


}