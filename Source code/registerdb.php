<?php   
   session_start();
   $username = $_REQUEST["username"];
   $password = $_REQUEST["password"];
   $register = "false";
   $count = 1;  


   $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
   mysql_select_db("s_jmeruga", $connection);
   $result = mysql_query ("SELECT * FROM myusers", $connection);

     while ($row = mysql_fetch_array($result))   {
		 $count++;
		 if($row['user_name'] == $username){
			 $register = "true";
			 $_SESSION["registerfailed"] = "true";
			 $_SESSION["regErrorMsg"] = "User Already Exist, Please try with different user name.";
			 header("Location:http://cs99.bradley.edu/~jmeruga/wineStore/register.php");
			 }		        
     }
	 if($register == "false"){
		unset($_SESSION["registerfailed"]);
		unset($_SESSION["regErrorMsg"]);
		
		$salt = substr($password, 0, 2);
		$userPswd = crypt($password, $salt);

		if(!mysql_query("INSERT INTO myusers values ($count,'$username','$userPswd','no')",$connection)){
			die('Error: ' . mysql_error());

		}
		else{
			$_SESSION["loginfailed"] = "true";
		    $_SESSION["errormessage"] = "Registration Successfully Done, A confirmation mail is sent and now you can login with your details.";


			$strTo = $username;
			list($name, $domail) = split("@", $username);
			$strSub = "Thank you for registering your account on Meruga's Wine Store.";
			$strFrom = "meruga@mail.bradley.edu";
			$strMailbody = "<p>Dear $name  ,</p>	<p>Thank you for Registering at Meruga's Wine Store.<br/>Here is Your new account details.</p>	<table width='200' border='0'>							  <tr>								<td>User Id: </td>								<td>$username</td>							  </tr>							  <tr>								<td>Password:</td>						<td>$password</td>							  </tr>							</table>							<p>Thank You,<br/>							Sales Team,<br/>							Jyothi Swaroop's Wine Store.</p>";
			mail($strTo,$strSub,$strMailbody,"Content-type: text/html; charset=us-ascii");

			header("Location:http://cs99.bradley.edu/~jmeruga/winestore/index.php");
			
		}
	 }
 
	   
	 ?>
