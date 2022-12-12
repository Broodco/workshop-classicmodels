<ul>
    <?php foreach ($products as $product) : ?>
        <li>
            <a href="/product.php?code=<?= $product['productCode']; ?>">
                <span><?= $product['productName'] ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
