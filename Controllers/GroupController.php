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
        if(self::$_instance == null)
        {
            self::$_instance = new GroupController();
        }
        return self::$_instance;
    }
    
    
    public function save(Group $group)
    {
        $response['groupId'] = DbManager::getInstance()->creatGroup($group);
        echo json_encode($response);
    }

}