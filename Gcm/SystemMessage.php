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

class SystemMessage
{
    private $_message;

    /**
     * SystemMessage constructor.
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->_message = new Message();
        $this->_message->addData(GcmCons::$_MSG_TYPE, $builder->getMsgType());
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->_message;
    }


}

class  Builder
{
    private $_msgType;
    private $msg;

    /**
     * @return mixed
     */
    public function getMsgType()
    {
        return $this->_msgType;
    }

    /**
     * @param mixed $msgType
     * @return $this
     */
    public function setMsgType($msgType)
    {
        $this->_msgType = $msgType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     * @return $this
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }


}

