<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('oauth/token', 'OAuthController::Authorize');
$routes->post('api/oauth/token', 'OAuthController::Authorize');

// OAuth2 маршруты
$routes->post('auth/token', 'OAuthController::Authorize');

// API маршруты
$routes->post('RatingApi/rating', 'RatingApi::rating');
$routes->get('OAuthController/user', 'RatingApi::user');
