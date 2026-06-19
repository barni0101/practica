<?php

namespace App\Controllers;

use App\Models\RatingModel;
use App\Models\OAuthModel;
use App\Services\OAuth;
use OAuth2\Request;

class RatingApi extends BaseController
{
    protected $model;
    protected $oauth;

    public function __construct()
    {
        $this->model = new RatingModel();
        $this->oauth = new OAuth();
        
        // CORS заголовки
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
    }

    /**
     * Получение списка рейтингов с пагинацией
     * POST /RatingApi/rating?page_group1=2
     */
    public function rating()
    {
        // Проверяем авторизацию
        if ($this->oauth->isLoggedIn()) {
            $OAuthModel = new OAuthModel();
            
            // Получаем параметры из запроса
            $per_page = $this->request->getPost('per_page');
            $search = $this->request->getPost('search');
            
            // Определяем, показывать все записи или только свои
            $user = $OAuthModel->getUser();
            $user_id = ($user->group_name == 'admin') ? null : $user->id;
            
            // Получаем данные
            $data = $this->model->getRatings($user_id, $search, $per_page);
            
            // Ответ с данными и параметрами пагинации
            return $this->respond([
                'ratings' => $data,
                'pager' => $this->model->pager->getDetails('group1')
            ]);
        } else {
            // Не авторизован
            return $this->failUnauthorized('Invalid token');
        }
    }

    /**
     * Получение информации о пользователе
     * GET /OAuthController/user
     */
    public function user()
    {
        if ($this->oauth->isLoggedIn()) {
            $OAuthModel = new OAuthModel();
            return $this->respond($OAuthModel->getUser());
        } else {
            return $this->failUnauthorized('Invalid token');
        }
    }
}