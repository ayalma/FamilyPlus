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

    public static $_LOGINCODE_TABLE = "LoginCodes";
    public static $_LOGINCODE_COL_USER_ID = "uid";
    public static $_LOGINCODE_COL_CODE = "code";
    public static $_LOGINCODE_COL_ID = "id";
    public static $_LOGINCODE_COL_EXPIRED = 'expired';

    public static $_BUYITEMS_TABLE = "BuyItems";
    public static $_BUYITEMS_M_NUMBER = "m_number";
    public static $_BUYITEMS_NAME = "name";
    public static $_BUYITEMS_PURCHASED = "purchased";
    public static $_BUYITEMS_PRICE = "price";
    public static $_BUYITEMS_DATE = "date";

    public static $_GROUP_TABLE = "Groups";
    public static $_GROUP_COL_ID = "id";
    public static $_GROUP_COL_ADMIN = "admin";
    public static $_GROUP_COL_NAME = "name";

    public static $_GU_TABLE = "Group_User";
    public static $_GU_COL_GROUP_ID = "gid";
    public static $_GU_COL_USER_ID = "uid";
    public static $_GU_COL_ROlE = "role";

    public static $_EVENT_TABLE = "Events";
    public static $_EVENT_COL_ID = "id";
    public static $_EVENT_COL_EVENT_TYPE_ID = "eid";
    public static $_EVENT_COL_USER_ID = "uid";
    public static $_EVENT_COL_DATE = "date";
    public static $_EVENT_COL_MESSAGE = "message";
    public static $_EVENT_COL_REPEAT_TYPE = "repeat_type";

    public static $_EVENTTYPE_TABLE = "EventTypes";
    public static $_EVENTTYPE_COL_ID = "id";
    public static $_EVENTTYPE_COL_NAME = "name";

    public static $_EU_TABLE = "Event_User";
    public static $_EU_COL_USER_ID = "uid";
    public static $_EU_COL_EVENT_ID = "eid";
    
}