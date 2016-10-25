<?php
 
  session_start();
  $username = "Guest@winestore.com";
   if (isset($_SESSION["username"])){
	 $username = $_SESSION["username"];
	}
  list($name, $domain) = split("@", $username);
  $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
  mysql_select_db("s_jmeruga", $connection);
  
  $dosearch = $_REQUEST["search"];
  $region = $_REQUEST["region"];
  $winetype = $_REQUEST["winetype"];
  
  $regionlist = mysql_query ("SELECT * FROM region", $connection);
  $winetypelist = mysql_query ("SELECT * FROM wine_type", $connection);
  
  if($dosearch == "true"){	   
	  $query1 = setupQuery($region,$winetype);
	  $newarrivals = mysql_query ($query1, $connection);
  
  }
  else
  {
  $newarrivals = mysql_query ("SELECT  wi.winery_name, w.year, w.wine_name, w.wine_id, 
                     w.description,i.cost
             FROM wine w, winery wi, inventory i
             WHERE w.winery_id = wi.winery_id
             AND w.wine_id = i.wine_id
             AND w.description IS NOT NULL
             GROUP BY w.wine_id
             ORDER BY i.date_added DESC LIMIT 4", $connection);
	}
	
	function setupQuery($region_name, $wine_type)
	{
	   // Show the wines stocked at the winestore that match
	   // the search criteria
	   $query = "SELECT DISTINCT wi.winery_name, 
						 w.year, 
						 w.wine_name, 
						 w.wine_id,
						 w.description,i.cost
				 FROM wine w, winery wi, inventory i, region r, wine_type wt
				 WHERE w.winery_id = wi.winery_id
				 AND w.wine_id = i.wine_id";
	
	   // Add region_name restriction if they've selected anything
	   // except "All"
	   if ($region_name != "All")
		  $query .= " AND r.region_name = '{$region_name}'
					  AND r.region_id = wi.region_id";
		  
	   // Add wine type restriction if they've selected anything
	   // except "All"
	   if ($wine_type != "All")
		  $query .= " AND wt.wine_type = '{$wine_type}'
					  AND wt.wine_type_id = w.wine_type";
	
	   // Add sorting criteria
	   $query .= " ORDER BY wi.winery_name, w.wine_name, w.year";
	
	   return ($query);
	}
  
 ?>

<html>
<head>
<style>
#wine {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#wine td, #customers th {
    font-size: 1em;
    border: 1px solid #98bf21;
    padding: 3px 7px 2px 7px;
}

#wine th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
}

#wine tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}
</style>
</head>
<body>
<h1 align="center">
<p> <img src="wine.png"  width="50" height="70">

<?php
	print "<span class='title'>Welcome $name</span>";
 
 		?>
		
<img src="wine.png"  width="50" height="70"></h1></p>
<div style="text-align:right">
<h2>
<a href='logout.php' style="text-decoration:none;" >Logout</a>
<a href='viewcart.php' style="text-decoration:none;" >View Cart</a>
</h2></div>
<table>
<tbody>
              <tr>
                <td>
		<form action="user.php" method="get">
                  <table width="100%" height="123" border="0">
                  <tr>
                    <td width="4%">&nbsp;</td>
                    <td width="38%"><span class="title">Region:</span></td>
                    <td width="58%"><label>
                      <select name="region">
					  <?php
					   while ($row = mysql_fetch_array($regionlist))   {
					   $regionname = $row['region_name'];
					   print "<option value='$regionname'>$regionname</option>";
					   }
					  ?>
                      </select>
                    </label></td>
                  </tr>
                  <tr>
                    <td height="39">&nbsp;</td>
                    <td><span class="title">Wine Type:</span></td>
                    <td><label>
                      <select name="winetype">
					   <?php
					   while ($row = mysql_fetch_array($winetypelist))   {
					   $winetypename = $row['wine_type'];
					   print "<option value='$winetypename'>$winetypename</option>";
					   }
					  ?>
                      </select>
                    </label></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="search" value="true"/><input type="submit" name="Submit" value="Search" /></td>
                  </tr>
				   <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
					<?php
					if($dosearch == "true"){
					print "<span class='title'><a href='producePdf.php?region=$region&winetype=$winetype'>Generate PDF</a></span>";
					}
					?>
					</td>
                  </tr>
                </table>
				</form>				</td>
              </tr>
            </tbody>
</table>

<table  height="480" border="0">
  <tr>
    <td><table  width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td width="100%"><h3><span class="rh2">
		  <?php
		  if($dosearch == "true"){
		    print "Search Results";
		  }
		  else{
		  print "New Arrivals";
		  }
		  ?></span></h3></td>
        </tr>
        <tr>
          <td  align="left">
			<table id="wine" width="100%" height="23" border="1">
			<tr>
			 <th width="104" align="center"><span class="title">Wine</span></th>
			 <th width="203" align="center"><span class="title">Winary Name</span></th>
			 <th width="99" align="center"><span class="title">Year</span></th>
			 <th width="247" align="center"><span class="title">Description</span></th>
			 <th width="44" align="center"><span class="title">Cost</span></th>
			 <th width="97" align="center"><span class="title">Buy</span></th>
			</tr>
			<?php
			while ($row = mysql_fetch_array($newarrivals))   {
			$wine_name = $row['wine_name'];
			$winary_name = $row['winery_name'];
			$year = $row['year'];
			$desc = $row['description'];
			$cost = $row['cost'];
			$wine_id = $row['wine_id'];
			print "<tr>";
			print "<td align='center'> $wine_name </td>";
			print "<td align='center'> $winary_name </td>";
			print "<td align='center'> $year </td>";
			if($desc != "")
				print "<td align='center'> $desc </td>";
			else
				print "<td align='center'> -- </td>";
			print "<td align='center'> $cost </td>";	
			print "<td align='center'><a href='cart.php?wine_id=$wine_id&no=1&search=$dosearch&region=$region&winetype=$winetype'>Add to cart</a></td>";				
			print "</tr>";		
			
			}
			?>
			</table>			
		</td>
<td style="vertical-align: top;" ><br><br><br>
<div align="top">
<img src="logo.jpg">
</div>
</td>
        </tr>
        
      </tbody>
    </table>
</body>
</html>
