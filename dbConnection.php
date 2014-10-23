<?php
ini_set('error_reporting', 'E_ALL^E_STRICT');


$database_name = "movie_rating_db";
$host = "localhost";
$user_name = "root";
$password = "";
$URL="http://192.168.10.2/movie_rating_server/movie_pic/";


mysql_connect($host, $user_name, $password);
//mysql_select_db('databaseName');
mysql_select_db($database_name);
?>
