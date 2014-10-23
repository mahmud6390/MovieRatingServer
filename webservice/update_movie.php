<?php
require_once '../dbConnection.php';
$uploads_dir = '../movie_pic/';

$uploadname = $_FILES["image"]["name"];
$movie_name =$_REQUEST['movie_name'];
$movie_description=$_REQUEST['movie_description'];
$image_data=$_REQUEST['image_data'];
$movie_category=$_REQUEST['movie_category'];
$movie_rating=$_REQUEST['movie_rating'];
$movie_id =$_REQUEST['movie_id'];
$rating_id =$_REQUEST['rating_id'];


move_uploaded_file($_FILES['image']['tmp_name'], $uploads_dir.$uploadname);
$image_path=$URL.$uploadname;


$update_to_movieTbl = "update  movie_tbl set movie_name='" . $movie_name . "',movie_description='" . $movie_description . "',
movie_category='".$movie_category."',image_path_thumble='".$image_path."' where movie_id='".$movie_id."'";
   if(mysql_query($update_to_movieTbl)) 
   {
   
	  $update_to_movieRating = "update movie_rating_rel_tbl set rating=" . $movie_rating . " where movie_id='" . $movie_id . "' and rating_id='".$rating_id."'";
	   if(mysql_query($update_to_movieRating)) echo "true";
	   
	   else echo "false";
   }
   else echo"false";
?>