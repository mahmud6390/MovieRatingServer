<?php
require_once '../dbConnection.php';

$movie_rating=$_REQUEST['movie_rating'];
$movie_id =$_REQUEST['movie_id'];
$update_to_movieRating = "insert into movie_rating_rel_tbl set rating=" . $movie_rating . ",movie_id='" . $movie_id . "' ";
if(mysql_query($update_to_movieRating)) echo "true";
   
else echo "false";

?>