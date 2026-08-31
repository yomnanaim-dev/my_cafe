<!-- <?php include '../layouts/header.php'; ?>

<?php include '../layouts/navbar.php'; ?>


<section class="products-section">

    <h1>Our Menu</h1>

    <div class="products-grid">

        <?php foreach ($products as $product): ?>

            <div class="product-card">

                <img
                    src="<?= $product['image'] ?>"
                    alt="<?= $product['name'] ?>"
                >

                <h2>
                    <?= $product['name'] ?>
                </h2>

                <p>
                     <?= $product['description'] ?> 
                </p>

                <span>
                    <?= $product['price'] ?> EGP
                </span>

                <button class="add-cart">
                    Add to Cart
                </button>

            </div>
  <?php endforeach; ?>

    </div>

</section>


<?php include '../layouts/footer.php'; ?> -->