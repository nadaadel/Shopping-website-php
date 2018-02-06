<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../classes/config.php';
include '../model/Product.php';

if (!empty($_POST)) {
    $filename = $_FILES['fileToUpload']['tmp_name'];
    $filePath = '/uploads/' . time() . '.png';
    $destination = __DIR__ . $filePath;
    if (!move_uploaded_file($filename, $destination)) {
        die('cant upload');
    }
    $pro = new Product($conn);
    $pro->setName($_POST['name']);
    $pro->setPrice($_POST['price']);
    $pro->setDescription($_POST['description']);
    $pro->setPhoto($filePath);
    $pro->setCategoryId($_POST['category']);
    $pro->save();
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
                <input name="name" type="text" class="form-control"/><br>

                <label> Price</label>
                <input name="price" type="text" class="form-control"/><br>

                <label>Category</label>
                <select class="form-control" name="category">
                    <option>------</option>
                    <option value="1">iphone</option>
                    <option value="2 ">htc</option>
                    <option value="3">samsung</option>
                    <option value="4">oppo</option>
                </select>
                <br>

                <label> Description</label>
                <input name="description" type="text"  class="form-control" /><br>

                <label> Product Photo</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required/>

                <button class="btn btn-info right " style="margin-left: 200px;
                        margin-top: 19px;" type="submit">Add Product</button>
            </form>
        </div>

    </body>
</html>