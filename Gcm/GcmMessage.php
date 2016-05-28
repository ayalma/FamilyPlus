<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 1:06 PM
 */

namespace Gcm\SystemMessage;


use Gcm\GcmCons;
use PHP_GCM\Message;

class GcmMessage extends Message
{

    /**
     * GcmMessage constructor.
     * @param $id
     * @param int $_msgType
     * @param int $actionType
     */
    public function __construct($id, $_msgType, $actionType)
    {
        parent::__construct();
        $this->setId($id)
            ->setMsgType($_msgType)
            ->setActionType($actionType);
    }

    /**
     * @param mixed $actionType
     * @return $this
     */
    public function setActionType($actionType)
    {
        $this->addData(GcmCons::$_ACTION_TYPE, $actionType);
        return $this;
    }

    /**
     * @param int $msgType
     * @return $this
     */
    public function setMsgType($msgType)
    {
        $this->addData(GcmCons::$_MSG_TYPE, $msgType);
        return $this;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->addData(GcmCons::$_ID, $id);
        return $this;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        $this->getData()[GcmCons::$_ID];
    }

    /**
     * @return mixed
     */
    public function getMsgType()
    {
        $this->getData()[GcmCons::$_MSG_TYPE];
    }

    /**
     * @return mixed
     */
    public function getActionType()
    {
        $this->getData()[GcmCons::$_ACTION_TYPE];
    }


}

