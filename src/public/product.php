<?php
declare(strict_types=1);

session_start();

require_once 'classes/ProductController.php';

$code = $_GET['code'];

$productController = new ProductController();
$productController->show($code);