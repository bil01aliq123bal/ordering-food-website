<?php
// start session
session_start();
//creatin the contants that store non repeating data
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_Username', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food_order');

$conn = mysqli_connect(LOCALHOST, DB_Username, DB_PASSWORD);
$db_select = mysqli_select_db($conn, DB_NAME); 
       //Select the database
