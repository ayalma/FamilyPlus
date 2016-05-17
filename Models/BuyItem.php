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
    private $id;
    private $_name; // item name.
    private $_purchased; // this mean that is item bought by user.
    private $_price;// price of item.
    private $_qunty;

    /**
     * BuyItem constructor.
     * @param int $id : id of item.
     * @param string $_name : name of item.
     * @param bool $_purchased : is purchased.
     * @param int $_price : price of item.
     * @param int $_qunty : count of this item.
     */
    public function __construct($id = 0, $_name = '', $_purchased = false, $_price = 0, $_qunty = 0)
    {
        $this->id = $id;
        $this->_name = $_name;
        $this->_purchased = $_purchased;
        $this->_price = $_price;
        $this->_qunty = $_qunty;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function getPurchased()
    {
        return $this->_purchased;
    }

    /**
     * @param bool $purchased
     */
    public function setPurchased($purchased)
    {
        $this->_purchased = $purchased;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
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