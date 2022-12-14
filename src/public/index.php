<?php
declare(strict_types=1);

session_start();

require_once 'vendor/autoload.php';

$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($url === 'login') {
    $authController = new AuthController();
    $authController->showLoginForm();
}

if ($url === '') {
    $productController = new ProductController();
    $productController->index();
}