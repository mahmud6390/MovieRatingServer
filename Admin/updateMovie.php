<?php
require_once 'sessionChecked.php';
require_once '../dbConnection.php';
require_once '../picture_resize.php';

$id = $_REQUEST['movie_id'];
$startIndex=$_REQUEST['page'];
$ipp=$_REQUEST['ipp'];
 //fetch data of id
$sql = "select movie_tbl.movie_id,movie_name,movie_description,movie_category,image_path_thumble,avg(rating) as 'movie_rating',rating_id 
			from movie_tbl,movie_rating_rel_tbl where movie_tbl.movie_id='".$id."' and movie_tbl.movie_id=movie_rating_rel_tbl.movie_id group by movie_tbl.movie_name ";
$query = mysql_query($sql)or die(mysql_error());
$data=mysql_fetch_assoc($query);

$movie_name=$data['movie_name'];
$movie_des=$data['movie_description'];
$movie_category=$data['movie_category'];
$movie_rating=$data['movie_rating'];
$image_path=$data['image_path_thumble'];
$rating_id=$data['rating_id'];

if ($_REQUEST['updateBtn']=='Update')
{
$id = $_POST['movie_id'];


$movie_name_REQUEST=$_POST['movie_name'];
$movie_des_REQUEST=$_POST['movie_description'];
$movie_category_REQUEST=$_POST['movie_category'];
$movie_rating_REQUEST=$_POST['movie_rating'];
$image_path_REQUEST=$_POST['image_path_thumble'];
	
    if ($movie_name_REQUEST == "") {
        echo "Movie name not null<br />";

    }
	$file=$_FILES['file1'];   
   
    if($file['name']!=""){

        foreach ($_FILES as $file) {


                if ((($file["type"] == "image/gif")
                        || ($file["type"] == "image/jpeg") || ($file["type"] == "image/jpg")
                        || ($file["type"] == "image/PNG") || ($file["type"] == "image/png"))
                        && ($file["size"]/1024 < 700)) 
				{
                    if ($file["error"] > 0) {
                        echo "Return Code: " . $file["error"] . "<br />";
                    } 
					else 
					{
						$extension=getExtension($file['name']);
                        $newfilename = time().".".$extension;
                        move_uploaded_file($file["tmp_name"], "../movie_pic/".$newfilename);
                        make_thumb("../movie_pic/".$newfilename ,"../movie_pic/".$newfilename ,150,120);
						$image_path=$URL.$newfilename;
						$update_to_movieTbl = "update  movie_tbl set movie_name='" . $movie_name_REQUEST . "',movie_description='" . $movie_des_REQUEST . "',
							movie_category='".$movie_category_REQUEST."',image_path_thumble='".$image_path."' where movie_id='".$id."'";
						   if(mysql_query($update_to_movieTbl)) 
						   {
							  $update_to_movieRating = "update movie_rating_rel_tbl set rating=" . $movie_rating_REQUEST . " where movie_id='" . $id . "' and rating_id='".$rating_id."'";
							  if(mysql_query($update_to_movieRating)) header("location:viewMovie.php?startIndex=0");exit;
								
							}
							else echo "false";
							
					}
                } else {
                    echo "Invalid file";
                }
            }
		}
		else 
		{
			$update_to_movieTbl = "update  movie_tbl set movie_name='" . $movie_name_REQUEST . "',movie_description='" . $movie_des_REQUEST . "',
							movie_category='".$movie_category_REQUEST."',image_path_thumble='".$image_path."' where movie_id='".$id."'";
						   if(mysql_query($update_to_movieTbl)) 
						   {
							  $update_to_movieRating = "update movie_rating_rel_tbl set rating=" . $movie_rating_REQUEST . " where movie_id='" . $id . "' and rating_id='".$rating_id."'";
							  if(mysql_query($update_to_movieRating)) header("location:viewMovie.php?startIndex=0");exit;
								
							}
							else echo "false";
							echo "picture not update";
            
        }
        
        
  
}

require_once 'header.php';
?>
<div class="login_container">

    <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="updateMovie.php">
        <input type ="hidden" name ="page" value ="<?php echo $startIndex ?>" />
         <input type ="hidden" name ="ipp" value ="<?php echo $ipp ?>" />
        <input type ="hidden" name ="movie_id" value ="<?php echo $id?>" />
		<input type ="hidden" name ="image_path_thumble" value ="<?php echo $image_path?>" />
        <br />
        <h4><label>Update Movie</label></h4>
        <br />
        <table>
             <tr>
                <td style="white-space: nowrap;">Movie Name :</td>
                <td>
                    <input type="text" name="movie_name" id="movie_name" value="<?php echo"$movie_name" ?>"> </input>
                </td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Movie category :</td>
                <td>
                    <p>
					<select name="movie_category">	
			
					  <option value="Entertainment" <?php echo ("Entertainment" == $movie_category)?" SELECTED":""?>>Entertainment</option>
					  <option value="Action" <?php echo ("Action" == $movie_category)?" SELECTED":""?>>Action</option>
					  <option value="Romantic" <?php echo ("Romantic" == $movie_category)?" SELECTED":""?>>Romantic</option>
					  <option value="Commedy" <?php echo ("Commedy" == $movie_category)?" SELECTED":""?>>Commedy</option>
					  <option value="3D" <?php echo ("3D" == $movie_category)?" SELECTED":""?>>3D</option>
					  <option value="Other" <?php echo ("Other" == $movie_category)?" SELECTED":""?>>Other</option>
					  </select>
					</p>
                </td>
            </tr>
			 <tr>
                <td style="white-space: nowrap;">Movie rating :</td>
                <td style="align:left">
                    <p>
					<select name="movie_rating">					
					  <option value="5" <?php echo ("5" == $movie_rating)?" SELECTED":""?>>5</option>
					  <option value="4" <?php echo ("4" == $movie_rating)?" SELECTED":""?>>4</option>
					  <option value="3.5" <?php echo ("3.5" == $movie_rating)?" SELECTED":""?>>3.5</option>
					  <option value="3" <?php echo ("3" == $movie_rating)?" SELECTED":""?>>3</option>
					  <option value="2.5" <?php echo ("2.5" == $movie_rating)?" SELECTED":""?>>2.5</option>
					  <option value="2" <?php echo ("2" == $movie_rating)?" SELECTED":""?>>2</option>
					  <option value="1" <?php echo ("1" == $movie_rating)?" SELECTED":""?>>1</option>
					  </select>
					</p>
                </td>
            </tr>
			<tr>
                <td style="white-space: nowrap;">Movie description :</td>
                <td>
                    <textarea name="movie_description" cols="70px" id="movie_description"><?php echo"$movie_des" ?></textarea>
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
					<input name="updateBtn" type="submit" value="Update" />
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