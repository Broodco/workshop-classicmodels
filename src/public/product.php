<?php
declare(strict_types=1);

session_start();

require_once 'classes/Database.php';

try {
    if (empty($_GET['code'])) {
        throw new Exception("Product code was not provided.");
    }

    $code = $_GET['code'];

    $db = new Database();
    $product = $db->query(
        "SELECT productCode, productName, buyPrice FROM products WHERE productCode = ?",
        [
            $code
        ]
    )->fetch();

} catch (Exception $e) {
    echo $e->getMessage();
}

// Afficher la page du produit

include 'public/views/includes/header.view.php';
include 'public/views/product.view.php';
include 'public/views/includes/footer.view.php';