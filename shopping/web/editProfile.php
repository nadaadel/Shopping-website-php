<?php
include '../classes/config.php';
include '../model/User.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$userid = $_SESSION['userId'];
$user = new User($conn, $userid);
if (!empty($_POST)) {
    $filename = $_FILES['fileToUpload']['tmp_name'];
    $filePath = '/uploads/' . time() . '.png';
    $destination = __DIR__ . $filePath;
    if (!move_uploaded_file($filename, $destination)) {
        die('cant upload');
    }
    $user->setPhoto($filePath);
    $user->setUsername($_POST['username']);
    $user->setName($_POST['name']);
    $user->setPhone($_POST['phone']);
    $user->setEmail($_POST['email']);
    $user->update();

    header("Location: account.php");
    exit;
}
?>
<html>
    <head>

    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            Username<input name="username" value="<?= $user->getUsername() ?>" />
            <br/>
            Name<input name="name" value="<?= $user->getName() ?>" />
            <br/>
            Email<input name="email" value="<?= $user->getEmail() ?>" />
            <br/>
            Phone<input name="phone" value="<?= $user->getPhone() ?>" />
            <br/>
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br>
            <button type="submit">Update</button>
        </form>
    </body>
</html>