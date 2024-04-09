<?php

namespace app\models;

use app\models\model;

class MessageModel {

    private int $idMessage;
    private string $email;
    private string $object;
    private string $message;

    public function __construct() {
        $this->table = 'message';
    }

    
}