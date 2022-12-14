<?php
declare(strict_types=1);

session_start();

require_once 'classes/ProductController.php';

$productController = new ProductController();
$productController->index();