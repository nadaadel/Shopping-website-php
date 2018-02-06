<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include '../classes/config.php';
include '../model/Products.php';
include '../model/Category.php';

$carts = array();
if (isset($_SESSION['cart'])) {
    $carts = $_SESSION['cart'];
}


if (!empty($_POST)) {
    if (isset($_POST['filter'])) {
        $category = new Category($conn);
        $catId = $category->getId($_POST['filter']);
        $products = new Products($conn);
        $productsobj = $products->getProducts($catId);
    } else if (isset($_POST['search'])) {

        $keyword = $_POST['text-search'];
        $products = new Products($conn);
        $productsobj = $products->getAuto($keyword);
    } else if (isset($_POST['all'])) {

        $products = new Products($conn);
        $productsobj = $products->getProducts();
    } else if (isset($_POST['logout'])) {
        unset($_SESSION['userId']);
        unset($_SESSION['cart']);
        header("Location: home.php");
        exit;
    } else if (isset($_POST['login'])) {

        header("Location: register.php");
        exit;
    } else if (isset($_POST['register'])) {

        header("Location: register.php");
        exit;
    } else if (isset($_POST['delete'])) {

        $pid = $_POST['pid'];
        $prod = new Product($conn);
        $prods = $prod->delete($pid);
        header("Location: home.php");
        exit;
    } else if (isset($_POST["searchVal"]) == "searches") {
        $rid = json_decode($_POST['id']);
        $ps = new Product($conn);
        $products = $ps->getProduct($rid);
    }
} else {
    $products = new Products($conn);
    $productsobj = $products->getProducts();
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
            <div class="col-md-6">
                <img class="img-responsive logo" src="images/logo.png" alt="logo">
            </div>
            <div class="checkout col-md-6">
                <form method="post" action="checkout.php">
                    <input class="checkout btn btn-warning" type="submit" name="checkout" value="checkout"/>
                </form>
                <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 2): ?> 
                    <form method="get" action="add-product.php">
                        <button class=" addBtn btn btn-info" style="    margin-top: 11px;
                                margin-left: 15px;" type="submit" name="add-product" value="Add Product"> add Product</button>
                    </form>
                <?php endif; ?>
                <?php if (!isset($_SESSION['userId'])): ?>
                    <div class="login-areas">
                        <form method="get" action="login.php">
                            <input class=" btn btn-success" type="submit" name="login" value="Login"/>

                        </form>
                        <form method="get" action="register.php" style=" margin-left: 20px;">
                            <input class="btn btn-success" type="submit" name="register" value="Sign Up"/>

                        </form>
                    </div>
                <?php else : ?>
                    <div class="login-area">
                        <a href="account.php" style=" margin: 10px;">Account</a> <br>
                        <a href="editProfile.php" style=" margin: 10px;padding-right: 2;display: inline-table;">Edit Profile</a> <br>

                        <form method="post" style="margin-left:50px">
                            <input class="btn btn-success" type="submit" name="logout" value="Logout"/>

                        </form>
                    </div>

                <?php endif; ?>

                <br>
            </div>


            <div class="categories col-md-12">
                <form method="post" action="home.php">
                    <input class="w3-button" type="submit" name="all" value="All"/>
                </form>
                <form method="post" action="home.php">
                    <input class="w3-button" type="submit" name="filter" value="iphone"/>
                </form>
                <form method="post" action="home.php">
                    <input class="w3-button" type="submit" name="filter" value="htc"/>
                </form>
                <form method="post" action="home.php">
                    <input class="w3-button" type="submit" name="filter" value="samsung"/>
                </form>
                <form method="post" action="home.php">
                    <input class="w3-button" type="submit" name="filter" value="oppo"/>
                </form>
                <form method="post" class="searchform frmSearch">
                    <input type="search" name="text-search" id="search-box" placeholder="search" />
                    <div id="suggesstion-box"    style="display: block" ></div>

                    <button style="margin-left: 144px" type="submit" name="search" value="Search" class="btn btn-default">Search</button>
                </form>
            </div>
            <?php foreach ($productsobj as $products): ?>
                <div class="product-item col-md-4">
                    <img src="<?= $products->getPhoto() ?>" class="img-r" width="200" height="200" />
                    <a href="view-product.php?id=<?= $products->getId(); ?>" class="proName " style="margin-left: 70px; color: #008EFF;"><?= $products->getName() ?></a>
                    <p class="proName " style="margin-left: 70px; ">  <?= $products->getPrice() ?></p>

                    <p class="proName " style="margin-left: 40px; margin-top: 0px;"> <?= substr($products->getDescription(), 0, 100); ?></p>
                    <div class="categories">



                        <?php if (isset($_SESSION['userId'])): ?>
                            <?php if (array_search($products->getId(), $carts)): ?>

                                <input class="i-button addToCart"type="submit" name="<?= $products->getId(); ?>" value="in Cart">

                            <?php else: ?>
                                <input class="i-button addToCart"type="submit" name="<?= $products->getId(); ?>" value="Add To Cart">

                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 2): ?> 

                            <form method="get" action="editproduct.php">
                                <input type="hidden" name="id" value="<?= $products->getId(); ?>" />
                                <input class="ie-button"type="submit" value="edit"/>
                            </form>
                            <form method="post" action="home.php">
                                <input type="hidden" name="pid" value="<?= $products->getId(); ?>" />
                                <input class="ie-button" name="delete" type="submit" value="Delete"/>
                            </form>    
                        <?php endif ?>
                    </div>



                </div>

            <?php endforeach; ?>
        </div>
    </body>
    <script  src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/myscript.js"></script>

</html>
