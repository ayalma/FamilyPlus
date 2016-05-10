<?php
/**
 * image model class.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/9/16
 * Time: 11:24 AM
 */

namespace Models;


class Image
{
    private $_id;
    private $_image;
    private $_type;

    /**
     * Image constructor.
     * @param $_id
     * @param $_image
     * @param $_type // 0 for profile and 1 for backdrop;
     */
    public function __construct($_id, $_image, $_type)
    {
        $this->_id = $_id;
        $this->_image = $_image;
        $this->_type = $_type;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }
    

}