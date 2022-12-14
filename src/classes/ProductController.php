<?php
declare(strict_types=1);

require_once 'classes/Database.php';

class ProductController
{
    public function index(): void
    {
        try {
            $db = new Database();
            $products = $db->query(
                'SELECT productCode, productName FROM products LIMIT 20'
            )->fetchAll();

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        include 'public/views/includes/header.view.php';
        include 'public/views/index.view.php';
        include 'public/views/includes/footer.view.php';
    }

    public function show(string $code): void
    {
        try {
            if (empty($code)) {
                throw new Exception("Product code was not provided.");
            }

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

        include 'public/views/includes/header.view.php';
        include 'public/views/product.view.php';
        include 'public/views/includes/footer.view.php';
    }
}