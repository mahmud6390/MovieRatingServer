<?php
require_once '../dbConnection.php';

$email = $_REQUEST['email'];
$password=$_REQUEST['password'];
$clean_password = md5($password);
$query="select * from login_tbl where email='".$email."' and password='".$clean_password."'";
$result = mysql_query($query);
$fetchQuery=mysql_fetch_assoc($result);
$count = mysql_num_rows($result);
$message_data = array();
$message_values = array();
		if($count>0)
		{
			$u_id=$fetchQuery['user_id'];
			$user_access=$fetchQuery['user_previleges'];
			$message_data[]=array(
			'status' => 'true',
			'user_id' => $u_id,
			'access_type'=>$user_access
			);
			
		}
		else
		{
		$message_data[] = array(
				'status' => 'false'
			);
			
			
		}
	$message_values['login_info']=	$message_data;
		
print_r(json_encode($message_values));
?>