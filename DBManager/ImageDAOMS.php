<?php
/**
 * image dao pattern implementation.
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/9/16
 * Time: 11:22 AM
 */

namespace DBManager;


use Models\Image;
use mysqli;

class ImageDAOMS implements ImageDAO
{

    private $_connection;

    function __construct(mysqli $_connection)
    {
        $this->_connection = $_connection;
    }

    /**
     * @param Image $image will save  to db.
     * @param $userId : id of user .
     * @return bool : status of saving as boolean.
     */
    function save(Image $image, $userId)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param $userId : id of user this image is for him/his.
     * @return array|null
     */
    function load($userId)
    {
        // TODO: Implement load() method.
    }

    /**
     * @param $id :id of image.
     * @return Image|null
     */
    function loadById($id)
    {
        // TODO: Implement loadById() method.
    }

    /**
     * @param $id : id of image
     * @return boolean : status of deleting.
     */
    function delete($id)
    {
        // TODO: Implement delete() method.
    }
}