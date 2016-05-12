<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/9/16
 * Time: 11:22 AM
 */

namespace DBManager;


use Models\Image;

interface ImageDAO
{
    /**
     * @param Image $image will save  to db.
     * @param $userId : id of user this image is for him/his.
     * @return bool : status of saving as boolean.
     */
    function save(Image $image, $userId);

    /**
     * @param $userId : id of user this image is for him/his.
     * @return array|null
     */
    function load($userId);

    /**
     * @param $id :id of image.
     * @return Image|null
     */
    function loadById($id);

    /**
     * @param $id : id of image
     * @return boolean : status of deleting.
     */
    function delete($id);

    /**
     * @param $userId : id of user
     * @return int : id of image
     */
    function GetImageId($userId);

}