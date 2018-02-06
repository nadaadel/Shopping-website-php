<?php
include '../classes/config.php';
include '../model/User.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['userId']) || !$_SESSION['userId']) {
    header("Location : login.php");
    exit;
}
$user_id = $_SESSION['userId'];

if (isset($_GET['id']) && $_GET['id']) {
    $userId = $_GET['id'];
}

$user = new User($conn, $user_id);
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
            <div class="col-md-12" style="margin: 0 auto; ">
                <img class=" img-r"src="<?= $user->getPhoto() ?>" width="200" height="200" /> 
                UserName :<b><?= $user->getUsername(); ?></b><br><br>
                Name :<b><?= $user->getName(); ?></b><br><br>
                Email: <b><?= $user->getEmail(); ?></b>

<?php if ($user_id == $_SESSION['userId']): ?>
                    <h3> <a href="editProfile.php" >Edit Profile</a></h3>
                <?php endif; ?>

            </div>
        </div>


    </body>

</html>