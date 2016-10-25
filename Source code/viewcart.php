<?php
 
  session_start();
  $username = "Guest@winestore.com";
   if (isset($_SESSION["username"])){
	 $username = $_SESSION["username"];
	}
  list($name, $domain) = split("@", $username);
  $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
  mysql_select_db("s_jmeruga", $connection);
  
  
 ?>
<html>
<head>
<script language="javascript">
		function validateQuantity( field ) {
	   if ( ! isInteger( field.value ))
		{ 
			alert( "Please enter a number" );
			field.focus();
			return false;
		}
		else
		{
		   if (field.value < 0)
		   {
			   alert ("Please enter quantity greater than zero");
			   return false;
		   }
		}
		return true;
	}
	</script>
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
<h1 align="center"><span class="rh2">Your Cart Details</span></h1>
<br>
<br>
<br>
<form action='updatecart.php' method ='get'>
<table id="wine" border='0'>
<td>
		  <?php
		  if (isset($_SESSION["cart"])){
	 			$cart = $_SESSION["cart"];
				$totalcost = 0;
				$totalitems =0;
				
				
				print "<table  width='834' height='23' border='0'>";
				
				print "<tr>";
				print "<th width='104' align='center'><span class='title'>Quantity</span></th>";
				print "<th width='203' align='center'><span class='title'>Wine</span></th>";
				print "<th width='99' align='center'><span class='title'>Unit Price</span></th>";
				print "<th width='247' align='center'><span class='title'>Total</span></th>";
				print "</tr>";
				
				foreach ($cart as $id => $value) {
				
				if($cart[$id] != 0){
					$costquery = mysql_query ("SELECT  wi.winery_name, w.year, w.wine_name, w.wine_id, i.cost FROM wine w, winery wi, inventory i WHERE w.winery_id = wi.winery_id AND w.wine_id = i.wine_id and w.wine_id = $id", $connection);
					
					while ($row = mysql_fetch_array($costquery))   {
						$cyear = $row['year'];
						$cwine_name = $row['wine_name'];
						$cwinery_name = $row['winery_name'];
						$ccost = $row['cost'];
						
						print "<tr>";
						$totalitems = $totalitems + $cart[$id];
						print "<td align='center'> <input type='text' size='3' maxlength='2' name='$id' value='$cart[$id]' onchange='validateQuantity(this)'/> </td>";
						print "<td align='center'> $cyear&nbsp;&nbsp;$cwine_name&nbsp;&nbsp;$cwinery_name</td>";
						print "<td align='center'> \$$ccost </td>";
						$tcost = $ccost * $cart[$id];
						print "<td align='center'> \$$tcost </td>";
						print "</tr>";
						$totalcost = $totalcost + $tcost;
					}
					}
					else{
					unset($cart[$id]);
					}
				}
				print "<tr>";
				print "<td align='center'><b>$totalitems Items</b></td>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print"<td align='center'><b>Total Cost: \$$totalcost</b></td>";
				
				
				
				print "</tr>";
				print "<tr>";
				print "<td>&nbsp;</td>";
				print "</tr>";
				print "<tr>";
				print"<td align='center'><u><span class='brand'><a href='updatecart.php?emptycart=true'>Empty Cart</a></span></u></td>";
				print"<td align='center'><u><span class='brand'><a href='checkout.php'>Checkout</a></span></u></td>";
				print"<td align='center'><u><span class='brand'><a href='user.php'>Search Wines</a></span></u></td>";
				print "<td align='center'><input type='submit' value='Update Quantities'/></td>";
				print "</tr>";
				
				print "</table>";
				
			}
			else
			{
		      print("<span class='title'>Cart Is Empty <u><a href='user.php'>Click Here</a></u> To add some items.</span>");
		  	}
			?>	
			
</td>
<td style="vertical-align: top;" ><br><br><br>
<div align="top">
<img src="logo.jpg">
</div>
</td>
			</form>
</body>
</html>