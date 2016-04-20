<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 10:43 AM
 */
class BuyItem
{
    private $_name; // item name.
    private $_purchased; // this mean that is item bought by user.
    private $_price;// price of item.
    private $_date;

    /**
     * BuyItem constructor.
     * @param $_name
     * @param $_purchased
     * @param $_price
     * @param $_date
     */
    public function __construct($_name, $_purchased, $_price, $_date)
    {
        $this->_name = $_name;
        $this->_purchased = $_purchased;
        $this->_price = $_price;
        $this->_date = $_date;
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

    





}