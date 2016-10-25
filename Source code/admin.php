<?php
 
  session_start();
  $username = "Guest@winestore.com";
   if (isset($_SESSION["username"])){
	 $username = $_SESSION["username"];
	}
  list($name, $domain) = split("@", $username);
  $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
  mysql_select_db("s_jmeruga", $connection);
  
  $winetypelist = mysql_query ("SELECT * FROM wine_type", $connection);
  $winerylist = mysql_query ("SELECT * FROM winery", $connection);
  
  
 ?>


<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link href="css/layout.css" rel="stylesheet" type="text/css" />
        <link href="css/menu.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
       <div class="container">

  <form action='updatewine.php' method ='get'>
			<?php
			 if (isset($_SESSION["adminMessage"])){
				 $message = $_SESSION["adminMessage"];
				 print "$message";
			}
			?>
            <ul id="nav">
 
                <li><a class="hsubs" href="addWine.php?option=add">Add Wine</a>
                    </li>
                <li><a class="hsubs" href="editWine.php">Edit Wine</a>
                   </li>
                <li><a class="hsubs" href="delWine.php">Delete Wine</a>
                  </li>

                <li><a href="logout.php">Logout</a></li>
                  <div id="lavalamp"></div>
            </ul>
		
<h1 align="center" color="#ffffff">	<?php
			print "<span class='title'>Welcome $name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
 		?>
		</h1>
<br>
<br>

 <img src="logo.png" >
<img src="bgwine.jpg">
          
	
				</form>	
					
        </div>
		

    </body>
</html>