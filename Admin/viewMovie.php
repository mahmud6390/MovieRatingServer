<?php
require_once 'sessionChecked.php';
require_once '../dbConnection.php';
require_once 'header.php';
include('paginator.class.php');

$query = "select count(*) from movie_tbl";
$result = mysql_query($query) or die(mysql_error());
$num_rows = mysql_fetch_row($result);

$pages = new Paginator;
$pages->items_total = $num_rows[0];
$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
$pages->paginate();




 $movie_Query = "select movie_tbl.movie_id,movie_name,movie_description,movie_category,image_path_thumble,avg(rating) as 'movie_rating',rating_id 
			from movie_tbl,movie_rating_rel_tbl where movie_tbl.movie_name IS NOT NULL and movie_tbl.movie_id=movie_rating_rel_tbl.movie_id group by movie_tbl.movie_name $pages->limit";
$movie_result = mysql_query($movie_Query)or die(mysql_error());

$current_page = $_REQUEST['page'];
$ipp=$_REQUEST['ipp'];

?>
<div class="login">
     <form id="form1" name="form1" method="post" action="viewMovie.php">
    <input type ="hidden" name ="startIndex" value ="<?php echo $current_page?>" />
    <table width="100%" border="10px" >
        
         <?php
            while ($data = mysql_fetch_assoc($movie_result)) {
            ?>

            <tr bgcolor="silver">
                <td style="border-right: 2px #00CCCC"><img class ="thumb_image" src="<?php echo $data['image_path_thumble']; ?>"</td>
               	<td style=" border-right: 1px black"><?php echo $data['movie_name']; ?></td>
				<td style=" border-right: 1px black"><?php echo $data['movie_description']; ?></td>
				<td style=" border-right: 1px black"><?php echo $data['movie_rating']; ?></td>
                <td> <a href="updateMovie.php?movie_id=<?php echo $data['movie_id'];?>&ipp=<?php echo $ipp;?>&page=<?php echo $current_page;?>">update</a></td>
                   
                
            </tr>

        <?php
        }
        ?>
    </table>
    <?php
                       echo $pages->display_pages();
                        echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
                        echo "<span class=\"\">".$pages->display_jump_menu().$pages->display_items_per_page()."</span>";
                       ?>
                </form>
</div>
<?php
        require_once 'footer.php';
?>
