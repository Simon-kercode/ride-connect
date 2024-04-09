<?php

namespace app\models;

use app\models\model;

class MessageModel extends Model{

    public int $idMessage;
    public $sendDate;
    public string $email;
    public string $object;
    public string $message;

    public function __construct() {
        $this->table = 'message';
    }

    
    /**
     * Set the value of idMessage
     *
     * @return  self
     */ 
    public function setIdMessage($idMessage)
    {
        $this->idMessage = $idMessage;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of object
     *
     * @return  self
     */ 
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the value of sendDate
     *
     * @return  self
     */ 
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }
}