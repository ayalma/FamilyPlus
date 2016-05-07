<?php
namespace DBManager;

use Models\Group;

require "../vendor/autoload.php";
/**
 * dao of Group model.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/20/16
 * Time: 10:19 AM
 */
interface GroupDAO
{
    /**
     * @param $userId : id of user (it is him/his phone number).
     * @return : all groups that user is member in them.
     */
    public function loadByUserId($userId);

    /**
     * @param Group $group : group to save.
     * @return int         : id of group
     */
    public function save(Group $group);

    /**
     * @param $groupId : id of group.
     * @param $userId : id of group.
     * @param $role : role of user in this group.
     * @return boolean : status of adding as boolean.
     */
    public function saveMember($groupId, $userId, $role);

    /**
     * @param $groupId : id of group.
     * @param $userId : id of user.
     * @return boolean : status of removing.
     */
    public function deleteMember($groupId, $userId);

    /**
     * @param $groupId : id of group.
     * @return array: all users in this group
     */
    public function loadGroupUser($groupId);
}