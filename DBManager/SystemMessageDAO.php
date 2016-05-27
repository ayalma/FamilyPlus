<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 2:27 PM
 */

namespace DBManager;


use Models\SystemMessage;

interface SystemMessageDAO
{

    /**
     * @param SystemMessage $sysMsg : message to save
     * @param $userId : user that message is for him/his.
     * @return boolean : status of saving.
     */
    public function save(SystemMessage $sysMsg, $userId);

    /**
     * @param $smId : id of system message
     * @return SystemMessage : message with requested id.
     */
    public function loadById($smId);

    /**
     * @param $userId : id of user.
     * @return array : load all SystemMessage for user.
     */
    public function load($userId);

    /**
     * @param $smId : id of System message.
     * @return boolean : status of deleting.
     */
    public function delete($smId);
}