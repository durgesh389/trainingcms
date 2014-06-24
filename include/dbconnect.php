<?php
//Data connection creation
define("DB_SERVER","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","qwerty");
define("DB_NAME","trainingcms");
$connect=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD) or die("Database connection issue");
mysqli_select_db($connect, DB_NAME);
?>