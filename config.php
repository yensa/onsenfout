<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'eloria');
define('DB_PASSWORD', 'rooted');
define('DB_NAME', 'orga');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("connexion impossible " . mysqli_connect_error());
}

?>