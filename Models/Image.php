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
    private $_name;
    private $_fileType;
    private $_size;
    private $_type;

    /**
     * Image constructor.
     * @param $_name
     * @param $_fileType
     * @param $_size
     * @param $_image
     * @param $_type
     */
    public function __construct($_name, $_fileType, $_size, $_type)
    {
        $this->_name = $_name;
        $this->_fileType = $_fileType;
        $this->_size = $_size;
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
    public function getFileType()
    {
        return $this->_fileType;
    }

    /**
     * @param mixed $fileType
     */
    public function setFileType($fileType)
    {
        $this->_fileType = $fileType;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }
    
    
    

}