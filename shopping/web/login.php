<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include '../classes/config.php';
include '../model/User.php';

$error = "";
if (!empty($_POST)) {
    if (isset($_REQUEST['username']) && !$_REQUEST['username']) {

        $error .= 'No Username <br>';
    }
    if (isset($_REQUEST['password']) && !$_REQUEST['password']) {

        $error .= "No Password <br>";
    }

    $state = false;
    $query = "SELECT * FROM user";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] == $_POST['username'] && $row['password'] == $_POST['password']) {
                session_start();
                $_SESSION['userId'] = $row['id'];
                $state = true;
                break;
            }
        }
    } else {
        echo "0 results";
    }


    if ($state) {

        header('Location: home.php');
        exit;
    } else {
        $error .= 'Login Faild';
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
    <h1 class="proName text-center" style="font-size:30px;"> Login to your Account</h1>
</head>
<body>
    <div class="container">
        <div class="error"> <?php echo $error ?> </div>
        <form  method ="post" class="center-block" style="margin-top: 40px;">
            UserName :<input name="username" class="form-control" type="text"/>
            Password :<input name="password"  class="form-control" type="password"/>
            <button type="submit" class="btn btn-info" style="margin: 30px;">Login </button>
        </form>
    </div>

</body>
</html>
<style>
    .error{
        color : red;
    }

</style>


