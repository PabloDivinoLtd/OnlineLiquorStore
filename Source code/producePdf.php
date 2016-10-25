<?php
  require "class.ezpdf.php";
  
   $connection = mysql_connect("cs99.bradley.edu","jmeruga","dingdong");   
   mysql_select_db("s_jmeruga", $connection);


  // Do the querying to produce the customer report
  $region = $_REQUEST["region"];
  $winetype = $_REQUEST["winetype"];

   $query = setupQuery($region,$winetype);
  
  $result = @ mysql_query($query, $connection);


  // Now, create a new PDF document
  $doc =& new Cezpdf();

  // Use the Helvetica font
  $doc->selectFont("./fonts/Helvetica.afm");

  // Number the pages
  $doc->ezStartPageNumbers(320, 15, 8);

  
  // Get the query rows, and put them in the table
  while ($row = mysql_fetch_array($result))
  {
  
    // Add current query row to the array of customer information
    $table[] = array(
          "WineId"=>$row["wine_id"],
          "Wine Name"=> "{$row["wine_name"]}",
          "Winery Name"=>$row["winery_name"],
          "Year"=>$row["year"],		  
          "Cost"=>"\${$row["cost"]}");

  }

  // Today's date is used in the table heading
  $date = date("d M Y");

  // Right-justify the numeric columns
  $options = array("cols" =>
               array("Year" =>
                 array("justification" => "right"),
                     "Cost" =>
                 array("justification" => "right")));

  // Output the table with a heading
  $doc->ezTable($table, "", "Wine Search Results For region $region and wine type $winetype",
                $options);

  $doc->ezSetDy(-15);

  
  // Output the document
  $doc->ezStream();

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
