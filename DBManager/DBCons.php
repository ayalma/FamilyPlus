<?php

/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 4/16/16
 * Time: 7:39 PM
 */
class DBCons
{
    public static $_host = "localhost";
    public static $_user = "root";
    public static $_password = "gamor2012";
    public static $db_name = "FamilyPlus";
    public static $port = "3306";

    public static $_DEVICE_TABLE = "Devices";
    public static $_DEVICE_COL_SERIAL = "serial";
    public static $_DEVICE_COL_API_NUMBER = "api_number";
    public static $_DEVICE_COL_BRAND = "brand";
    public static $_DEVICE_COL_MODEL = "model";
    public static $_DEVICE_COL_REGISTER_ID = "register_id";
    public static $_DEVICE_COL_USER_ID = "uid";

    public static $_USER_TABLE = "Users";
    public static $_USER_COL_MOBILE_NUMBER = "m_number";
    public static $_USER_COL_FNAME = "fname";

    public static $_GU_TABLE = "Group_User";
    public static $_GU_GROUP_ID = "gid";
    public static $_GU_USER_ID = "uid";
    public static $_GU_ROLE = "role";

}