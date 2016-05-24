<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/17/16
 * Time: 12:30 PM
 */

namespace DBManager;


use Models\Buys;

interface BuysDAO
{

    /**
     * @param Buys $buys buyItem for save
     * @param $userId : id of user.
     * @return bool
     */
    public function save(Buys $buys, $userId);

    /**
     * @param $userId : id of user.
     * @return array  : users Buys .
     */
    public function load($userId);

    /**
     * @param $userId : id of user.
     * @return array  : buys shared with user.
     */
    public function loadSharedBuys($userId);
    

    /**
     * @param int $buyId : id of buy.
     * @param int $userId : id of user.
     * @return bool : status of saving.
     */
    public function addReceiver($buyId, $userId);

    /**
     * @param $buyId : id of buy .
     * @return array : user who access to this buy.
     */
    public function getReceiver($buyId);

    /**
     * @param $Id : id of buy .
     * @return bool : 
     */
    public function delet($Id);
}