<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 5/5/2016
 * Time: 11:36 AM
 */

namespace Controllers;

use DBManager\DbManager;
use Models\Group;

class GroupController
{
    private static $_instance = null;

    /**
     * GroupController constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new GroupController();
        }
        return self::$_instance;
    }


    public function save(Group $group, $adminRole)
    {

        $response['groupId'] = DbManager::getInstance()->saveGroup($group);

        if (is_int($response['groupId']) && $response['groupId'] != 0) {
            $response['save'] = DbManager::getInstance()->saveMember($response['groupId'], $group->getAdmin(), $adminRole);
        }
        echo json_encode($response);
    }

    public function addMember($groupId, $userId, $role)
    {
        if (DbManager::getInstance()->haveAGroup($userId)) {
            /* if user is member of any group .
             we can't add him/his to another group.
            */

            $errorMsg['error'] = '403';
            $errorMsg['describe'] = 'user already is member of one family';

            header('HTTP/1.1' . " " . '403' . 'Forbidden');
            header("Content-Type:" . $_SERVER['HTTP_ACCEPT']);
            echo json_encode($errorMsg);

        } else {

            $response['save'] = DbManager::getInstance()->saveMember($groupId, $userId, $role);
            echo json_encode($response);
        }
    }

    public function deleteMember($groupId, $userId)
    {
        $response['delete'] = DbManager::getInstance()->deleteMember($groupId, $userId);
        echo json_encode($response);
    }

    public function GetGroupUser($groupId)
    {
        $res = DbManager::getInstance()->getGroupUsers($groupId);
        echo json_encode($res);
    }

}