<?php
require_once '../dbConnection.php';
$movie_id =$_REQUEST['movie_id'];
//it's using for original pictures for a perticular movie.
//It's return multiple image

$movie_Query = "select * from movie_pic_tbl where movie_id='".$movie_id."'";
$movie_result = mysql_query($movie_Query);
$id = mysql_num_rows($movie_result);
$messageResult = mysql_fetch_assoc($movie_result);
$picture_values = array();
	if($id>0)
		{
					
			$message_values[] = array(
				'count' => $id,
				'originalPath' => $messageResult['image_path_original'],
				'picture_id'=>$messageResult['picture_id']
				
				);
				
		}
		else
			{
				$message_values[] = array(
					'count' => 0
					);
			}
		
$message_data['values'] = $message_values;
 print_r(json_encode($message_data));
?>