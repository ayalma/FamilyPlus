<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:45 AM
 */
interface UserDAO
{

    /**
     * @param User $user user will be save in data base.
     * @return mixed status of saving as boolean.
     */
    public function save(User $user);
}