<?php

class UserIdentity extends CUserIdentity
{
    private $_id;
    
    public function authenticate()
    {
        $record=Users::model()->findByAttributes(array('Email'=>$this->username));
        if($record===null || $record->activated==0)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->Password!==$this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->userid;
            $this->setState('TYPE', $record->type);
            $this->setState('name', $record->Fname);
            $this->setState('DepId', $record->DepId);
            $this->setState('activated', $record->activated);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}