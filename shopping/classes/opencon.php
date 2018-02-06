<?php

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$conn){
    
    echo 'Faild to connect to database' or mysqli_connect_error();
}

