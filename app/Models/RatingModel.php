<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'ratings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'gender', 'birthday', 'since', 'user_id', 'picture_url'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Получение рейтингов с пагинацией и поиском
     * 
     * @param int|null $user_id - ID пользователя (если null - все записи)
     * @param string $search - подстрока для поиска
     * @param int|null $per_page - количество элементов на странице
     * @return mixed
     */
    public function getRatings($user_id = null, $search = "", $per_page = null)
    {
        $model = $this->like('name', is_null($search) ? '' : $search, 'both');
        
        if (!is_null($user_id)) {
            $model = $model->where('user_id', $user_id);
        }
        
        // Пагинация
        return $model->paginate($per_page, 'group1');
    }
}