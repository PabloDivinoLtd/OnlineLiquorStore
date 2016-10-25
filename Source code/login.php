<?php   
   session_start();
   $username = $_REQUEST["login"];
   $password = $_REQUEST["password"];
   $isadmin = $_REQUEST["isadmin"];
   $login = "false";
   
   $salt = substr($password, 0, 2);
   $userPswd = crypt($password, $salt);


   $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
   mysql_select_db("s_jmeruga", $connection);
   $result = mysql_query ("SELECT * FROM myusers", $connection);

     while ($row = mysql_fetch_array($result))   {
		 if($row['user_name'] == $username && $row['password'] == $userPswd){
			 if($row['admin'] == $isadmin){				
				if($isadmin == "yes"){
					$login = "true";
					unset($_SESSION["loginfailed"]);
					unset($_SESSION["errormessage"]);
					$_SESSION["username"] = $username;
					header("Location:http://cs99.bradley.edu/~jmeruga/winestore/admin.php");
				}
				if($isadmin == "no"){
					$login = "true";
					unset($_SESSION["loginfailed"]);
					unset($_SESSION["errormessage"]);
					$_SESSION["username"] = $username;
					header("Location:http://cs99.bradley.edu/~jmeruga/winestore/user.php");
				}
			 }
			 else{
				 $login = "true";
				 $_SESSION["loginfailed"] = "true";
				 $_SESSION["errormessage"] = "User Type Mismatch, please Login again";
				 header("Location:http://cs99.bradley.edu/~jmeruga/winestore/index.php");
			 } 

		 }
		        
     }
	 if($login == "false"){
		$_SESSION["loginfailed"] = "true";
    	$_SESSION["errormessage"] = "Login Failed, Please Try Again";
	    header("Location:http://cs99.bradley.edu/~jmeruga/winestore/index.php");
	 }
 
	   
	 ?>
