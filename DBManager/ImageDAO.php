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
     * @param $type : type of image.
     * @return Image|null
     */
    function load($userId, $type);

    /**
     * @param $id :id of image.
     * @return Image|null
     */
    function loadById($id);

    /**
     * @param $id : id of image
     * @return boolean : status of deleting.
     */
    function deleteById($id);

    /**
     * this method will delete user last image in db with type.
     * @param $userId : id of user.
     * @param $type : type of image.
     * @return boolean: status of saving as boolean.
     */
    function delete($userId, $type);


}