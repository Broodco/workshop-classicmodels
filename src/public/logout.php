<?php
declare(strict_types=1);

session_start();

require_once 'classes/AuthController.php';

$authController = new AuthController();
$authController->logout();