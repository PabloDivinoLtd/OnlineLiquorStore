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
  
  $option = $_REQUEST["option"];
  $editwineid = $_REQUEST["editwineid"];
  $edityear = "";
  $editdesc = "";
  $editcost="";
  
  if($option == "edit"){
  $editwinename  = mysql_query ("SELECT * FROM wine where wine_id=$editwineid", $connection);
  $editwineqty  = mysql_query ("SELECT * FROM inventory where wine_id=$editwineid", $connection);
  
  }
  
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




<?php
			if($option == "add")
				print "Enter Wine Details:";
			else
				print "Edit Wine Details:";	
			?>
			
	
<span class="brand">Wine Name:</span>
<?php
			if($option == "add"){
			print "<input type='text' name='winename' />";
			}
			else{ 
			while ($row = mysql_fetch_array($editwinename))   {
					   $winename = $row['wine_name'];
					   $edityear = $row['year'];
					   $editdesc = $row['description'];
					   print "<input type='text' name='winename' value='$winename'/>";
			 }
			 
			}
			?>


<?php
			if($option == "add"){
			print "<tr>";
			print "<td><span class='brand'>Wine Type  :</span> </td>";
			print "<td><select name='winetype'>";
			
			 while ($row = mysql_fetch_array($winetypelist))   {
					   $winetypename = $row['wine_type'];
					   $witypeid = $row['wine_type_id'];
					   print "<option value='$witypeid'>$winetypename</option>";
			 }
			 
            print "</select></td>";
			print "</tr>";
			
			}?>
<span class="brand">Year:</span>
if($option == "add"){
			print "<input type='text' name='year' size='4' maxlength='4'/>";
			}
			else{ 
					   print "<input type='text' name='year' size='4' maxlength='4' value='$edityear'/>";
			}
			?>
			
<?php
			if($option == "add"){
			print "<tr>";
			print "<td><span class='brand'>Winery :</span></td>";
			print "<td><select name='winery'>";
             
			 while ($row = mysql_fetch_array($winerylist))   {
					   $wineryname = $row['winery_name'];
					   $wineryid = $row['winery_id'];
					   print "<option value='$wineryid'>$wineryname</option>";
			 }
			
            print "</select></td>";
			print "</tr>";
			}
			?>
			

<span class="brand">Desciption:</span>
 <?php
				if($option == "add"){
				print "<textarea name='description'></textarea>";
				}
				else{ 
				   print "<textarea name='description'>$editdesc</textarea>";
				}
			?>
<span class="brand">Quantity :</span>
 <?php
				if($option == "add"){
				print "<input type='text' name='qty' size='3' maxlength='3'/>";
				}
				else{ 
				while ($row = mysql_fetch_array($editwineqty))   {
						   $quantity = $row['on_hand'];
						   $editcost = $row['cost'];
						   print "<input type='text' name='qty' size='3' maxlength='3' value='$quantity'/>";
				 }
				 
				}
			?>

<span class="brand">Cost:</span>
<?php
				if($option == "add"){
				print "<input type='text' name='cost' size='6' maxlength='6'/>";
				}
				else{ 
						   $cost = $row['cost'];
						   print "<input type='text' name='cost' size='6' maxlength='6' value='$editcost'/>";
				}
			?>


<?php
			  if($option == "add")
			  {
			   print "<input type='hidden' name='option' value='add'/>";
			  }
			  else
			  {
			  print "<input type='hidden' name='option' value='edit'/>";
			  print "<input type='hidden' name='editwineid' value='$editwineid'/>";
			  
			  }
			  ?>
			   <input type='submit' name ='submit' value='Submit'/>
			  <input type='reset' name='reset' value='Reset'/>


	</form>	
        </div>
		

    </body>
</html>