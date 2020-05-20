<?php


$DB_SERVER = getenv("DB_SERVER");
$DB_PASSWORD = getenv("DB_PASSWORD");
$DB_USERNAME = getenv("DB_USERNAME");
$DB_NAME = getenv("DB_NAME");

$link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
if($link === false){
    die("ERROR: Could not connect. ". $DB_USERNAME . mysqli_connect_error());
}
?>