<?php
  session_start();
 ?>
 
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Wine Store Login</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<?php
				 if (isset($_SESSION["loginfailed"])){
				 	if($_SESSION["loginfailed"] == "true"){
					    $message = $_SESSION["errormessage"];
				 		print "<br><br><font color='red'>$message</font>";
						}
				 }
				 ?>
				 <br><br><br><br>
<h1 align="center" ><font size="9" color="#212121" >Welcome to</font>
				 <br></h1>
<center>
<img src="logo.png" width="300" height="200"></center>
				 <form method="get" action="login.php" class="login">
				 
    <p>
      <label for="login">Email:</label>
      <input type="text" name="login" id="login" value="">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">
    </p>
<p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="title">Type:</span>
<select name="isadmin">
 <option value="no">User</option>
 <option value="yes">Admin</option>
  </select>
    <p class="forgot-password"><a href="register.php">New User? Sign UP here</a>
</p>
    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>

</p>
  </form>

</body>
</html>
