<?php   
   session_start();
   $winename = $_REQUEST["winename"];
   $winetype = $_REQUEST["winetype"];
   $year = $_REQUEST["year"];
   $winery = $_REQUEST["winery"];
   $description = $_REQUEST["description"];
   $qty = $_REQUEST["qty"];
   $cost = $_REQUEST["cost"];
   $option = $_REQUEST["option"];
   $delwineid = $_REQUEST["delwineid"];
   $editwineid = $_REQUEST["editwineid"];
   
   $wineid = 0;

   $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
   mysql_select_db("s_jmeruga", $connection);

   $wineidquery = mysql_query ("SELECT max(wine_id) FROM wine", $connection);

     while ($row = mysql_fetch_array($wineidquery))   {
		 
			$wineid = $row[0]; 
	 }
    
	$wineid += 1;

	if($option  == "add"){
	   
	   $insertwine = "INSERT INTO wine VALUES('$wineid', '$winename', '$winetype', '$year', '$winery', '$description')";
       $insertinv="INSERT INTO inventory VALUES('$wineid', '1', '$qty', '$cost', SYSDATE())";

       if(mysql_query($insertwine) && mysql_query($insertinv)) 
	   { 
		    $_SESSION["adminMessage"] = "New Wine $winename Added.";
		    header("Location:http://cs99.bradley.edu/~jmeruga/winestore/admin.php");
	  }
	}

	if($option  == "delete"){
		
	$delwine= "DELETE FROM wine where wine_id='$delwineid'";
	$delinv= "DELETE FROM inventory where wine_id='$delwineid'";
	
	if(mysql_query($delwine) && mysql_query($delinv)) 
	   { 
		    $_SESSION["adminMessage"] = "Wine Deleted.";
		    header("Location:http://cs99.bradley.edu/~jmeruga/winestore/admin.php");
	  }


	}

	if($option  == "edit"){
	   
	   $editwine = "update wine set wine_name='$winename',year='$year' where wine_id='$editwineid'";
       $editinv="update inventory set on_hand='$qty',cost='$cost' where wine_id='$editwineid'";

       if(mysql_query($editwine) && mysql_query($editinv)) 
	   { 
		    $_SESSION["adminMessage"] = "Wine $winename Updated.";
		    header("Location:http://cs99.bradley.edu/~jmeruga/winestore/admin.php");
	  }
	}


	 ?>
