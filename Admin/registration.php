<?php
require_once '../dbConnection.php';
session_start();
if ($_REQUEST['Submit'] == 'SignUp') {
    $email = $_POST['email'];
    $password = $_POST['password'];
	$user_type = $_POST['user_type'];
	$name = $_POST['name'];
	if ($email=="" || $password=="") 
	{
	 echo "Please put your mail,password";
       
		exit;
    } 
	else 
	{    
    
    $clean_email = strip_tags(stripslashes(mysql_real_escape_string($email)));
//$clean_password = sha1(strip_tags(stripslashes(mysql_real_escape_string($password))));
    $clean_password = md5($password);
    $sql = "insert into login_tbl set email='$clean_email',password='$clean_password',user_previleges='$user_type',name='$name'";
    mysql_query($sql);
		if(mysql_query($sql)==0)
		{
		 echo "Email already exist";
		}
		else{
		$_SESSION['email'] = $email;
			header("location:header.php");
			exit;
		}
	 
	}
	
}
?>
<html>
    <head>
        <link href="../css/style.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body>
        <div class="login_container_top"></div>
<div class="login_container">

        <form name="form" method="post" action="registration.php">
            
                
         <h4>Signup:</h4>

        <table>
        <tr>
            <td>Email:</td>
            <td>
                <input name="email" type="text" id="email" />
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input name="password" type="password" id="password" />
            </td>
        </tr>
        <tr>
			<td>User access type : </td>
            <td><p>
					<select name="user_type">
					  <option value="normal">Normal</option>
					  <option value="admin">Admin</option>
					  </select>
					</p>
			</td>
		</tr>
		<tr>
			<td>Name:	</td>
			<td> <input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td></td>
			<td>
					<input type="submit" name="Submit" value="SignUp" id="SignUp" style="width: 100px" />
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

    </body>
</html>


