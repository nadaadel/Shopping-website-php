<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../classes/config.php';
include '../model/Products.php';
include '../model/Category.php';


if (!empty($_POST)) {
    if (isset($_POST["keyword"])) {

        $products = new Products($conn);
        $ProductArray = $products->getAuto($_POST["keyword"]);
        $productName = array();
        foreach ($ProductArray as $country) {

            $productName [] = $country->getName();
        }
    } 
    else if (isset($_POST["actionT"]) == "add") {
        if (!($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $proId = json_decode($_POST['id']);
       $_SESSION['cart'][$proId]= $proId;
    } else
    if (isset($_POST["actionR"]) == "remove") {
        $rid = json_decode($_POST['rid']);
       $key = array_search($rid, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$rid]);
        }      
    }else if(isset($_POST["searchVal"]) == "searches") {
        echo 'wasl';
       $vall = json_decode($_POST['id']);
        $_SESSION['test'] = $vall;
        
    }
}

?>
<html>
    <?php if (!empty($productName)): ?>
        <ul id="name-list">
            <?php foreach ($productName as $key => $value): ?> 

                <li onClick="selectCountry('<?php echo $value; ?>');"><?php echo $value; ?></li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</html>