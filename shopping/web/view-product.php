<?php
include '../classes/config.php';
include '../model/Product.php';
include '../model/Rate.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$product = "";
$rate = new Rate($conn);
$total = '';
$total_product_rating = '';

if (isset($_GET['id'])) {
    $pro = new Product($conn);
    $product = $pro->getProduct($_GET['id']);
} else if (isset($_POST['submit_rating'])) {

    $result = $rate->save($_POST['prod'], $_POST['phprating']);
    if ($result) {
        $idd = 0;
        $idd = $_POST['prod'];
        echo 'inserted rate';
        header("Location: view-product.php?id=$idd");
        exit;
    }
}

$rows = $rate->getRate($product->getId());
$count = 0;
$totall = 0;
foreach ($rows as $r) {
    $count++;
    $totall += $r->getRates();
}
if ($count != 0) {
    $total_product_rating = $totall / $count;
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
            <div  class="center-block" style="margin-top: 40px;">

                <div class="product-item col-md-12">
                    <h1 class="proName " style="margin-left: 10px; ">  <?= $product->getName() ?></h1><br>
                    <img src="<?= $product->getPhoto() ?>" class="img-r" width="400" height="400" /><br><br>

                    Price :<b class="proName " style="margin-left: 10px; ">  <?= $product->getPrice() ?></b> <br>

                    Description : <b class="proName " style="margin-left: 10px; margin-top: 0px;"> <?= $product->getDescription() ?></b>

                    <form method="post" action="view-product.php">
<?php if ($totall): ?>
                            <p id="total_votes">Total Votes:<?php echo $totall; ?></p>
<?php endif; ?>
                        <div class="divs">
                        <?php if ($total_product_rating): ?>
                                <p><?= $product->getName() ?> <span style="color:mediumvioletred; ">Rate</span>(<?php echo $total_product_rating; ?>)</p>
                        <?php endif; ?>
                            <input type="hidden" id="php1_hidden" value="1">
                            <img  src="images/star1.png" onmouseover="change(this.id);" id="php1" class="php">
                            <input type="hidden" id="php2_hidden" value="2">
                            <img src="images/star1.png" onmouseover="change(this.id);" id="php2" class="php">
                            <input type="hidden" id="php3_hidden" value="3">
                            <img src="images/star1.png" onmouseover="change(this.id);" id="php3" class="php">
                            <input type="hidden" id="php4_hidden" value="4">
                            <img src="images/star1.png" onmouseover="change(this.id);" id="php4" class="php">
                            <input type="hidden" id="php5_hidden" value="5">
                            <img src="images/star1.png" onmouseover="change(this.id);" id="php5" class="php">
                        </div>
                        <input type="hidden" name="prod" value="<?= $product->getId(); ?>" >
                        <input type="hidden" name="phprating" id="phprating" value="0">
                        <input type="submit" value="Rate Now" class="btn btn-info" style="margin: 25px;background-color: mediumvioletred"name="submit_rating">

                    </form>
                </div>


            </div>
        </div>
        <script src="js/jquery-3.1.1.js"></script>
        <script  type="text/javascript" src="js/rating.js"></script>

    </body>
</html>
