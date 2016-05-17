<?php
namespace Models;
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:43 AM
 */
class BuyItem implements \JsonSerializable
{
    private $_name; // item name.
    private $_purchased; // this mean that is item bought by user.
    private $_price;// price of item.
    private $_date;
    private $_users;// user that will received this items.
    private $_qunty;
    private $_title;

    /**
     * BuyItem constructor.
     * @param $_name
     * @param $_purchased
     * @param $_price
     * @param $_date
     * @param $_users
     * @param $_qunty
     * @param $_title
     */
    public function __construct($_name = '', $_purchased = '', $_price = '', $_date = '', $_users = '', $_qunty = '', $_title = '')
    {
        $this->_name = $_name;
        $this->_purchased = $_purchased;
        $this->_price = $_price;
        $this->_date = $_date;
        $this->_users = $_users;
        $this->_qunty = $_qunty;
        $this->_title = $_title;
    }


    public static function fromJSON($json)
    {
        $obj = new BuyItem();
        $jsonValue = json_decode($json, true);
        foreach ($jsonValue as $key => $value)
            $obj->{'_' . $key} = $value;
        return $obj;

    }


    /**
     * @return mixed
     */
    public function getPurchased()
    {
        return $this->_purchased;
    }

    /**
     * @param mixed $purchased
     */
    public function setPurchased($purchased)
    {
        $this->_purchased = $purchased;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->_users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->_users = $users;
    }

    /**
     * @return int
     */
    public function getQunty()
    {
        return $this->_qunty;
    }

    /**
     * @param int $qunty
     */
    public function setQunty($qunty)
    {
        $this->_qunty = $qunty;
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
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
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