<?php
require_once '../dbConnection.php';
$uploads_dir = '../movie_pic/';

$uploadname = $_FILES["image"]["name"];
$movie_name =$_REQUEST['movie_name'];
$movie_description=$_REQUEST['movie_description'];
$movie_category=$_REQUEST['movie_category'];
$movie_rating=$_REQUEST['movie_rating'];

//file path creation and keep the image.
move_uploaded_file($_FILES['image']['tmp_name'], $uploads_dir.$uploadname);
$image_path=$URL.$uploadname;

//now i am using same image in thumble view and original view.
//But main concept is one is thumble view and more images will be in original view
//with same movie_id

$insert_to_movieTbl = "insert into movie_tbl set movie_name='" . $movie_name . "',movie_description='" . $movie_description . "',
movie_category='".$movie_category."',image_path_thumble='".$image_path."'";
 if(mysql_query($insert_to_movieTbl)) 
   {
   $selectMovieIdQuery="select movie_id from movie_tbl where movie_name='".$movie_name."'";
   $result = mysql_query($selectMovieIdQuery);   
   $fetchQuery=mysql_fetch_assoc($result);
   $movie_id=$fetchQuery['movie_id'];
   $insert_to_movieRating = "insert into movie_rating_rel_tbl set movie_id='" . $movie_id . "',rating= ". $movie_rating . "";
   mysql_query($insert_to_movieRating); 
   $insert_to_movie_pic_tbl = "insert into movie_pic_tbl set image_path_original='".$image_path."',movie_id='" . $movie_id . "'";
   if(mysql_query($insert_to_movie_pic_tbl)) echo "true";
   else echo "false";
   }
   else echo"false";
?>