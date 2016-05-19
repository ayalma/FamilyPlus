<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/17/16
 * Time: 12:26 PM
 */

namespace Models;


class Buys implements \JsonSerializable
{
    private $_id;
    private $_owner;
    private $_title;
    private $_date;
    private $_users;
    private $_buyItems;


    /**
     * Purchases constructor.
     * @param int $_id
     * @param string $_title
     * @param int $_date
     * @param array $_users
     * @param array $_buyItems
     * @param User $owner
     */
    public function __construct($_id = 0, $_title = '', $_date = 0, $_users = array(0), $_buyItems = array(0), User $owner = null)
    {
        $this->_id = $_id;
        $this->_title = $_title;
        $this->_date = $_date;
        $this->_users = $_users;
        $this->_buyItems = $_buyItems;
        $this->_owner = $owner;
    }


    public static function fromJSON($json)
    {
        $obj = new Buys();
        $obj->setBuyItems(null);
        $obj->setUsers(null);
        $jsonValue = json_decode($json, true);
        foreach ($jsonValue as $key => $value)
            $obj->{'_' . $key} = $value;
        return $obj;

    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return int
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param int $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->_users;
    }

    /**
     * @param array $users
     */
    public function setUsers($users)
    {
        $this->_users = $users;
    }

    /**
     * @return array
     */
    public function getBuyItems()
    {
        return $this->_buyItems;
    }

    /**
     * @param array $buyItems
     */
    public function setBuyItems($buyItems)
    {
        $this->_buyItems = $buyItems;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->_owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->_owner = $owner;
    }


    function jsonSerialize()
    {
        $json = array();

        foreach ($this as $key => $value) {
            $key = str_replace('_', '', $key);
            $json[$key] = $value;
        }

        return $json; // or json_encode($json)
    }


}