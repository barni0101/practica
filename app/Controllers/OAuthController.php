<?php

namespace App\Controllers;

use App\Models\OAuthModel;
use App\Services\OAuth;
use OAuth2\Request;

class OAuthController extends BaseController
{
    private $OAuthModel;
    private $OAuth;

    public function __construct()
    {
        $this->OAuth = new OAuth();
        
        // Разрешаем запросы с любых доменов (для разработки)
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
    }

    public function Authorize()
    {
        $request = Request::createFromGlobals();
        $this->OAuth->server->handleTokenRequest($request)->send();
    }
}