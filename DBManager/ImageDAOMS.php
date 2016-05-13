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
        $sql = 'INSERT  INTO ' . DBCons::$_IMAGE_TABLE
            . ' (' . DBCons::$_IMAGE_COL_USER_ID
            . ', ' . DBCons::$_IMAGE_COL_TYPE
            . ', ' . DBCons::$_IMAGE_COL_FILE_TYPE
            . ', ' . DBCons::$_IMAGE_COL_SIZE
            . ', ' . DBCons::$_IMAGE_COL_NAME
            . ') VALUES (?,?,?,?,?)';

        $statement = $this->_connection->prepare($sql);

        $statement->bind_param('disis', $userId, $image->getType(),
            $image->getFileType(), $image->getSize(), $image->getName());

        $res = $statement->execute();
        $statement->close();

        return $res;
    }

    /**
     * @param $userId : id of user this image is for him/his.
     * @param $type
     * @return Image|null
     */
    function load($userId, $type)
    {
        $sql = 'SELECT  ' . DBCons::$_IMAGE_COL_ID
            . ',' . DBCons::$_IMAGE_COL_TYPE
            . ',' . DBCons::$_IMAGE_COL_FILE_TYPE
            . ',' . DBCons::$_IMAGE_COL_SIZE
            . ',' . DBCons::$_IMAGE_COL_NAME
            . ' FROM ' . DBCons::$_IMAGE_TABLE
            . ' WHERE ' . DBCons::$_IMAGE_COL_TYPE
            . ' = ? AND ' . DBCons::$_IMAGE_COL_ID
            . ' = (SELECT max(' . DBCons::$_IMAGE_COL_ID
            . ') FROM ' . DBCons::$_IMAGE_TABLE
            . ' WHERE ' . DBCons::$_IMAGE_COL_USER_ID . ' = ?)';


        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('id', $type, $userId);

        $statement->bind_result($imageId, $type, $fileType, $size, $name);
        $statement->execute();

        $image = null;

        if ($statement->fetch()) {
            $image = new Image($name, $fileType, $size, $type);
        }

        $statement->close();

        return $image;
    }

    /**
     * @param $id :id of image.
     * @return Image|null
     */
    function loadById($id)
    {
        $sql = 'SELECT ' . DBCons::$_IMAGE_COL_ID
            . ',' . DBCons::$_IMAGE_COL_TYPE
            . ',' . DBCons::$_IMAGE_COL_FILE_TYPE
            . ',' . DBCons::$_IMAGE_COL_SIZE
            . ',' . DBCons::$_IMAGE_COL_NAME
            . ' FROM ' . DBCons::$_IMAGE_TABLE
            . ' WHERE ' . DBCons::$_IMAGE_COL_ID . ' = ?';


        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $id);

        $statement->bind_result($imageId, $type, $fileType, $size, $name);
        $statement->execute();

        $image = null;

        if ($statement->fetch()) {
            $image = new Image($name, $fileType, $size, $type);
        }

        $statement->close();

        return $image;
    }

    /**
     * @param $id : id of image
     * @return boolean : status of deleting.
     */
    function delete($id)
    {
        $sql = 'DELETE FROM ' . DBCons::$_IMAGE_TABLE
            . ' WHERE ' . DBCons::$_IMAGE_COL_ID . ' = ?';

        $statement = $this->_connection->prepare($sql);
        $statement->bind_param('i', $id);

        $res = $statement->execute();
        $statement->execute();

        return $res;

    }



}