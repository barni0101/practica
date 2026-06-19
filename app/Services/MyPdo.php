<?php

namespace App\Services;

use IonAuth\Models\IonAuthModel;
use OAuth2\Storage\Pdo;

class MyPdo extends Pdo
{
    protected $ion_auth;
    
    public function __construct($connection, $config = array())
    {
        parent::__construct($connection, $config);
        $this->ion_auth = new IonAuthModel();
    }

    protected function hashPassword($password)
    {
        return $this->ion_auth->hashPassword($password);
    }

    protected function checkPassword($user, $password): bool
    {
        return $this->ion_auth->verifyPassword($password, $user['password']);
    }
}