<?php

class Product extends Database
{
    public function findAll(): array|false
    {
        try {
           return $this->query(
                'SELECT productCode, productName FROM products LIMIT 20'
            )->fetchAll();

        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function find(string $code): array|false
    {
        try {
            return $this->query(
                "SELECT productCode, productName, buyPrice FROM products WHERE productCode = ?",
                [
                    $code
                ]
            )->fetch();

        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }
}