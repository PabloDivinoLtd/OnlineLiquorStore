<?php
 
  session_start();
  $username = "Guest@winestore.com";
   if (isset($_SESSION["username"])){
	 $username = $_SESSION["username"];
	}
  list($name, $domain) = split("@", $username);
  $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
  mysql_select_db("s_jmeruga", $connection);
  
  $winenamelist = mysql_query ("SELECT * FROM wine", $connection);
  
  
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
        <header>
 
          </header>
       <div class="container">

  <form action='updatewine.php' method ='get'>
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
		</form>	
<h1> Edit A Wine</h1>
<form action='addWine.php' method ='get'>
		  <table width='603' border='0'>
			<tr>
			<td width='234' height='55'><strong><span class="title">Selet  Wine to Edit:</span></strong> </td>
			<td width='359'>&nbsp;</td>
			</tr>
			<tr>
			<td><span class="brand">Wine Name:</span></td>
			<td><label>
			<select name='editwineid'>
              <?php
			 while ($row = mysql_fetch_array($winenamelist))   {
					   $winename = $row['wine_name'];
					   $wineid = $row['wine_id'];
					   print "<option value='$wineid'>$winename</option>";
			 }
			 ?>
            </select>
			</label></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			
			<tr>
			<td><input type='hidden' name='option' value='edit'/>
			  <input type='submit' name ='submit' value='Submit'/></td>
			<td><input type='reset' name='reset' value='Reset'/></td>
			
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td><span class='title'><a href='admin.php'>Back</a></span></td>
			</tr>
			</table>
		  </form>	

					
        </div>
		

    </body>
</html>