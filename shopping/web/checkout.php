<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../classes/config.php';
include '../model/Product.php';
include '../model/Category.php';

$carts = array();
if (isset($_SESSION['cart'])) {
    $carts = $_SESSION['cart'];
}

$totalPrice = 0;

$productsobj = array();
if ($carts) {
    foreach ($carts as $ids) {
        $pro = new Product($conn);
        $product = $pro->getProduct($ids);
        $productsobj [] = $product;
    }
} else {

    echo '<h1>No Product in Cart</h1>';
}
foreach ($productsobj as $prices) {
    $totalPrice = $totalPrice + $prices->getPrice();
}
?>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <?php if ($productsobj): ?>
                <h1 style="color: #761c19;" class="text-center" > Your Total Price<h2 style="color: #761c19;"id="priceText"><?= $totalPrice ?></h2> </h1>
                <?php foreach ($productsobj as $products): ?>

                    <div class="proCheck col-md-12" style="display: flex;">

                        <img src="<?= $products->getPhoto(); ?>" class="img-r" width="100" height="100" />
                        <p class="proName"> <?= $products->getName(); ?></p>
                        <p class="proName"> <?= $products->getPrice(); ?></p>

                        <input class="rmBtn btn btn-danger" type="submit" proPrice ="<?= $products->getPrice(); ?>" name="<?= $products->getId(); ?>" value="Remove"/>

                    </div>

                <?php endforeach; ?> 
            <?php endif; ?>
        </div>
    </body>
    <script  src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/myscript.js"></script>
</html>


