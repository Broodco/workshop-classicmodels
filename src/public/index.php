<?php
declare(strict_types=1);

session_start();

require_once 'classes/Database.php';

try {
    $db = new Database();
    $products = $db->query(
        'SELECT productCode, productName FROM products LIMIT 20'
    )->fetchAll();

} catch (Exception $e) {
    echo $e->getMessage();
}

// Afficher les produits

include 'public/views/includes/header.view.php';
include 'public/views/index.view.php';
include 'public/views/includes/footer.view.php';