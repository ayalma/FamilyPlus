<?php
/**
 * Created by PhpStorm.
 * User: alimohammadi
 * Date: 5/27/16
 * Time: 1:36 PM
 */

namespace Gcm\EventMessage;


class EventMessage
{
    private $_msgType;
    // this is in test level.
}

class  Builder
{
    private $_msgType;

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


}

