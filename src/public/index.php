<?php
declare(strict_types=1);

require_once 'public/db/connection.php';

try {
    // Récupérer les produits
    $stmt = $pdo->prepare('SELECT productCode, productName FROM products LIMIT 20');
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo $e->getMessage();
}

// Afficher les produits

include 'public/views/includes/header.view.php';
include 'public/views/index.view.php';
include 'public/views/includes/footer.view.php';