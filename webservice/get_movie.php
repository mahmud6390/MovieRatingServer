<?php
require_once '../dbConnection.php';

//select all movie info with rating from rating table.remove null value by checking group by.

$movie_Query = "select movie_tbl.movie_id,movie_name,movie_description,movie_category,image_path_thumble,avg(rating) as 'movie_rating',rating_id 
			from movie_tbl,movie_rating_rel_tbl where movie_tbl.movie_name IS NOT NULL and movie_tbl.movie_id=movie_rating_rel_tbl.movie_id group by movie_tbl.movie_name";
$movie_result = mysql_query($movie_Query);
$id = mysql_num_rows($movie_result);
			
$picture_values = array();
if($id>0)
		{
			while ($messageResult = mysql_fetch_assoc($movie_result))
			{
					$message_values[] = array(
												'status' => 'true',
												'movie_id' => $messageResult['movie_id'],
												'movie_name'=>$messageResult['movie_name'],
												'movie_description' => $messageResult['movie_description'],
												'movie_category'=>$messageResult['movie_category'],
												'image_path'=>$messageResult['image_path_thumble'],
												'movie_rating'=>$messageResult['movie_rating'],
												'rating_id'=>$messageResult['rating_id']
											);
					
			}
				
				
		}
		else
			{
				$message_values[] = array(
						'status' => 'false'
						);
			}
		
$message_data['values'] = $message_values;
 print_r(json_encode($message_data));
?>