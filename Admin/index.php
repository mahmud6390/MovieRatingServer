<?php
require_once '../dbConnection.php';
session_start();

if ($_REQUEST['Submit'] == 'Login') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $clean_email = strip_tags(stripslashes(mysql_real_escape_string($email)));
//$clean_password = sha1(strip_tags(stripslashes(mysql_real_escape_string($password))));
    $clean_password = md5($password);
    $sql = "SELECT * FROM login_tbl WHERE email='$clean_email' and password='$clean_password'";
    $rs = mysql_query($sql) or die("Query failed");

    $numofrows = mysql_num_rows($rs);

    if ($numofrows == 1) {
        $_SESSION['email'] = $email;
        header("location:header.php");
    } else {
        echo "email and  password doesnot match";
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

        <form name="form" method="post" action="index.php">
            
                
                    <h4>Member Login:</h4>

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
            <td></td>

            <td>
                <input type="submit" name="Submit" value="Login" id="Login" style="width: 41px" />
            </td>
        </tr>
        <tr>
            <td><a href="registration.php">New user?</a></td>
            <td>
                <span id="lblMessage"></span>
            </td>

        </tr>
    </table>
            
        </form>
            </div>

    </body>
</html>


