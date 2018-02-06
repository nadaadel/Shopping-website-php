<?php
include '../classes/config.php';
include '../model/Product.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$product = "";

if (isset($_GET['id'])) {
    $pro = new Product($conn);
    $product = $pro->getProduct($_GET['id']);
}

if (!empty($_POST)) {
    $filename = $_FILES['fileToUpload']['tmp_name'];
    $filePath = '/uploads/' . time() . '.png';
    $destination = __DIR__ . $filePath;
    if (!move_uploaded_file($filename, $destination)) {
        die('cant upload');
    }
    $product->setName($_POST['name']);
    $product->setPrice($_POST['price']);
    $product->setDescription($_POST['description']);
    $product->setPhoto($filePath);
    $product->setuserId($_POST['user_id']);
    $product->setCategoryId($_POST['category']);
    $product->update();

    header("Location: home.php");
    exit;
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
            <form  method ="post" enctype="multipart/form-data" class="center-block" style="margin-top: 40px;">

                <label>Product Name</label>
                <input name="name" type="text" value="<?= $product->getName(); ?>" class="form-control" /> <br>

                <label> Price</label>
                <input name="price" type="text" value="<?= $product->getPrice() ?>" class="form-control"/><br>

                <label> Category</label>
                <input name="category" type="text" value="<?= $product->getCategoryId() ?>" class="form-control"/><br>

                <label> user Id</label>
                <input name="user_id" type="text" value="<?= $product->getUserId() ?>" class="form-control"/><br>

                <label> Description</label>
                <input name="description" type="text" value="<?= $product->getDescription() ?>" class="form-control" /><br>


                <label> Product Photo</label>
                <input type="file" name="fileToUpload" id="fileToUpload" value="<?= $product->getPhoto() ?>"
                       class="form-control" required/><br>

                <button  class="btn btn-info right " style="margin-left: 200px;
                         margin-top: 19px;" type="submit">Update </button>
            </form>
        </div>

    </body>
</html>
