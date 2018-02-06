<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../classes/config.php';
include '../model/User.php';

$error = "";
if (!empty($_POST)) {
    if ((!isset($_POST['username'])) || !$_POST['username']) {
        $error .= "No Username Value";
    } else {
        if (strlen($_POST['username']) > 20) {
            echo 'Values > 20';

            $error .= "max length is 20 char";
        }
    }

    if (((!isset($_POST['password'])) || !$_POST['password']) || ((!isset($_POST['cpassword'])) || !$_POST['cpassword'])) {

        $error .= "No Password Value";
    } else {
        if (strlen($_POST['password']) < 6) {
            $error .= "Password can't less than 6 character";
        }
        if ($_POST['password'] != $_POST['cpassword']) {

            $error .= "Passwod NOT Matches";
        }
    }

    if ($error == "") {
        session_start();

        $product = new User($conn);
        $product->setName($_POST['name']);
        $product->setUsername($_POST['username']);
        $product->setEmail($_POST['email']);
        $product->setPassword($_POST['password']);
        $_SESSION['userId'] = $product->save();
        echo '<pre>';
        print_r($_SESSION['userId']);
        echo '</pre>';

        header("Location: home.php");
        exit;
    } else {
        die($error);
    }
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
    <h1 class="proName text-center" style="font-size:30px;"> Create Account</h1>
</head>
<body>
    <div class="container">
        <div class="error"> <?php echo $error ?> </div>

        <form  method ="post" class="center-block" style="margin-top: 40px;">
            <label> UserName</label>
            <input name="username" class="form-control" type="text" value="<?php echo isset($_POST['username']) ? $_POST['username'] : "" ?>"/> <br>


            <label> Name</label>
            <input name="name" type="text" class="form-control"/><br>


            <label> Email</label>
            <input name="email" type="text" class="form-control"/><br>


            <label> Password</label>
            <input name="password" type="password" class="form-control"/><br>

            <label> Confirm Password</label>
            <input name="cpassword" type="password" class="form-control"/><br>


            <button class="btn btn-info"type="submit">Register </button>
        </form>
    </div>   
</body>

</html>
