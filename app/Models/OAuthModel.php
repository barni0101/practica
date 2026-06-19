<?php

namespace App\Models;

use CodeIgniter\Model;

class OAuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'username', 'password', 'first_name', 'last_name', 'active', 'group_name'];

    /**
     * Получение информации о текущем пользователе по токену
     */
    public function getUser()
    {
        // Здесь нужно получить пользователя из токена
        // В упрощённом варианте возвращаем первого пользователя
        return $this->first();
    }
}