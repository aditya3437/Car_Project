<?php
if (!defined("HOSTNAME")) {
    define("HOSTNAME", "localhost:3307"); 
}

if (!defined("USERNAME")) {
    define("USERNAME", "root"); 
}

if (!defined("PASSWORD")) {
    define("PASSWORD", ""); 
}

if (!defined("DATABASE")) {
    define("DATABASE", "newcar"); 
}


$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connection) {
    die("Couldn't connect to the database: " . mysqli_connect_error());
} 

?>
