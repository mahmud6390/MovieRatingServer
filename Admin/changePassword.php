<?php
require_once 'sessionChecked.php';
require_once '../dbConnection.php';


if ($_REQUEST['Submit'] == 'Changed') {
    $oldPassword = $_POST['oldPasswordTxt'];
    $newPassword=$_POST['newPasswordTxt'];
    $retryPasswordTxt=$_POST['retryPasswordTxt'];
    
    if($newPassword!=$retryPasswordTxt){
        echo "Retype Password doesnot match";
    }
    elseif($newPassword=="" || $retryPasswordTxt=="" )
    {
         echo "Not empty";

    }
    else
    {
            
       $password= md5($oldPassword);
       $sql="select email from login_tbl where email='".$_SESSION['email']."' and password='".$password."' limit 1";
       $result=mysql_query($sql);
       $data=mysql_fetch_assoc($result);
   
      if($data['email']!=$_SESSION['email'])
      {
         echo "email not found";
      }
      else
      {
       $new_password=md5($newPassword);

       $updateQuery="update login_tbl set password='".$new_password."' where email='".$data['email']."'";

       mysql_query($updateQuery);       
       header("location:home.php");exit;
     
      }

    }

}


require_once 'header.php';

?>
<div class="login_container">

        <form name="form" method="post" action="changePassword.php">


                    <h4>Password Changed:</h4>

                   <table>
        <tr>
            <td style="white-space: nowrap;">Old password:</td>
            <td>
                <input name="oldPasswordTxt" type="password" id="oldPasswordTxt" />
            </td>
        </tr>

        <tr>
            <td style="white-space: nowrap;">New Password:</td>
            <td>
                <input name="newPasswordTxt" type="password" id="newPasswordTxt" />
            </td>
        </tr>
        <tr>
            <td style="white-space: nowrap;">Retry Password:</td>
            <td>
                <input name="retryPasswordTxt" type="password" id="retryPasswordTxt" />
            </td>
        </tr>
        <tr>
            <td></td>

            <td>
                <input type="submit" name="Submit" value="Changed" id="Login" style="width:auto" />
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
