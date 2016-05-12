<?php
/**
 * controller class for image .
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/10/16
 * Time: 10:11 AM
 */

namespace Controllers;


use DBManager\DbManager;
use Models\Image;

class ImageController
{

    private static $_instance = null;

    /**
     * GroupController constructor.
     */
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new ImageController();
        }
        return self::$_instance;
    }

    public function save(Image $image, $userId)
    {
        $response['save'] = DbManager::getInstance()->saveImage($image, $userId);
        echo json_encode($response);
    }

    public function getImageById($imageId)
    {
        $image = DbManager::getInstance()->loadImageById($imageId);

        header("Content-length:" . $image->getSize());
        header("Content-type:" . $image->getFileType());
        header("Content-Disposition: attachment; filename=" . $image->getName());

        $distination = 'C:/xampp/htdocs/FamilyPlus/upload/' . $image->getName();
        echo file_get_contents($distination);

    }

    public function getImages($userId)
    {
        $response = DbManager::getInstance()->loadImage($userId);
        echo json_encode($response);
    }

    public function delete($imageId)
    {
        $response['delete'] = DbManager::getInstance()->deleteImage($imageId);
        echo json_encode($response);
    }

    public function getImageId($userID)
    {
        $response['imageID'] = DbManager::getInstance()->getImageID($userID);
        echo json_encode($response);
    }


}