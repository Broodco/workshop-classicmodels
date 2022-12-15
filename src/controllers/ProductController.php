<?php
declare(strict_types=1);


class ProductController
{
    public function index(): void
    {
        $product = new Product();
        $products = $product->findAll();

        include 'views/includes/header.view.php';
        include 'views/index.view.php';
        include 'views/includes/footer.view.php';
    }

    public function show(string $code): void
    {
        if (empty($code)) {
            throw new Exception("Product code was not provided.");
        }

        $productModel = new Product();
        $product = $productModel->find($code);

        include 'views/includes/header.view.php';
        include 'views/product.view.php';
        include 'views/includes/footer.view.php';
    }
}