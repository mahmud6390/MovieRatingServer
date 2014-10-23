<?php
require_once 'sessionChecked.php';
require_once '../dbConnection.php';
require_once '../picture_resize.php';

if ($_REQUEST['submit'] == 'Submit') {
$movie_name =$_POST['movie_name'];
$movie_description=$_POST['movie_description'];
$movie_category=$_POST['movie_category'];
$movie_rating=$_POST['movie_rating'];

    $file=$_FILES['file1'];   
   
        if($file['name']!="") {

            foreach ($_FILES as $file) {

                if ((($file["type"] == "image/gif")
                        || ($file["type"] == "image/jpeg") || ($file["type"] == "image/jpg")
                        || ($file["type"] == "image/PNG") || ($file["type"] == "image/png"))
                        && ($file["size"]/1024 < 700)) {
                    if ($file["error"] > 0) {
                        echo "Return Code: " . $file["error"] . "<br />";
                    } else {

                        $extension=getExtension($file['name']);
                        $newfilename = time().".".$extension;
                        move_uploaded_file($file["tmp_name"], "../movie_pic/".$newfilename);
                        make_thumb("../movie_pic/".$newfilename ,"../movie_pic/".$newfilename ,150,120);
						$image_path=$URL.$newfilename;
						echo $insert_to_movieTbl = "insert into movie_tbl set movie_name='" . $movie_name . "',movie_description='" . $movie_description . "',
						movie_category='".$movie_category."',image_path_thumble='".$image_path."'";
						   if(mysql_query($insert_to_movieTbl)) 
						   {
						  echo $selectMovieIdQuery="select movie_id from movie_tbl where movie_name='".$movie_name."'";
						   $result = mysql_query($selectMovieIdQuery);   
						   $fetchQuery=mysql_fetch_assoc($result);
						   $movie_id=$fetchQuery['movie_id'];
						   $insert_to_movieRating = "insert into movie_rating_rel_tbl set movie_id='" . $movie_id . "',rating= ". $movie_rating . "";
						   mysql_query($insert_to_movieRating); 
						   $insert_to_movie_pic_tbl = "insert into movie_pic_tbl set image_path_original='".$image_path."',movie_id='" . $movie_id . "'";
						   if(mysql_query($insert_to_movie_pic_tbl)) header("location:viewMovie.php?startIndex=0");exit;
						   
						   }
						   else echo"false";
                        
                    }
                } else {
                    echo "Invalid file";
                }
            }
        }
        else {
            echo "file path not null";
        }
    
}
require_once 'header.php';
?>
<div class="login_container">
    <form action="insertMovie.php" method="post"
          enctype="multipart/form-data">
        

        <h4>Insert movie</h4>

        <table>
             <tr>
                <td style="white-space: nowrap;">Movie Name :</td>
                <td>
                    <input type="text" name="movie_name" id="movie_name" />
                </td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Movie category :</td>
                <td>
                    <p>
					<select name="movie_category">					
					  <option value="Entertainment">Entertainment</option>
					  <option value="Action">Action</option>
					  <option value="Romantic">Romantic</option>
					  <option value="Commedy">Commedy</option>
					  <option value="3D">3D</option>
					  <option value="Other">Other</option>
					  </select>
					</p>
                </td>
            </tr>
			 <tr>
                <td style="white-space: nowrap;">Movie rating :</td>
                <td>
                    <p>
					<select name="movie_rating">					
					  <option value="5">5</option>
					  <option value="4">4</option>
					  <option value="3.5">3.5</option>
					  <option value="3">3</option>
					  <option value="2.5">2.5</option>
					  <option value="2">2</option>
					  <option value="1">1</option>
					  </select>
					</p>
                </td>
            </tr>
			<tr>
                <td style="white-space: nowrap;">Movie description :</td>
                <td>
                    <textarea name="movie_description" cols="70px" id="movie_description"></textarea>
                </td>
            </tr>
			

            <tr>
                <td style="white-space: nowrap;">Browse Image:</td>
                <td>
                    <input type="file" name="file1" class="file" />
                </td>
            </tr>
            <tr>
                <td></td>

                <td>
                    <input type="submit" name="submit" value="Submit" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <span id="lblMessage"></span>
                </td>

            </tr>
        </table>

    </form>
</div>
<?php
require_once 'footer.php';
?>
