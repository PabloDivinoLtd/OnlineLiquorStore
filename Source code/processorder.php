<?php
 
  session_start();
  $username = "Guest@winestore.com";
   if (isset($_SESSION["username"])){
	 $username = $_SESSION["username"];
	}
  list($name, $domain) = split("@", $username);
  $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
  mysql_select_db("s_jmeruga", $connection);
  
  $title = $_REQUEST["title"];
  $fname = $_REQUEST["fname"];
  $lname = $_REQUEST["lname"];
  $address = $_REQUEST["address"];
  $city = $_REQUEST["city"];
  $state = $_REQUEST["state"];
  $zip = $_REQUEST["zip"];
  $mobile = $_REQUEST["mobile"];
  $email = $_REQUEST["email"];
  $cardtype = $_REQUEST["cardtype"];
  $cardnumber = $_REQUEST["cardnumber"];
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  $shmethod = $_REQUEST["shmethod"];
  
 ?>
<html>
<head>
</head>
<body>
<h1 align="center">Your Order Summary</h1>
<br><br><br>
<?php
		   if (isset($_SESSION["cart"])){
		   
		   $strTo = $email;
		   $strSub = "Wine Store Order Summary.";
		   $strFrom = "jmeruga@mail.bradley.edu";
		   $strMailbody = "<p>Dear $title $fname $lname   ,</p>
						<p>Thank you for Registering at Meruga's Wine Store.<br/>
						   Here is Your Order Sumary</p>";
		   
		  print "<b>Dear $title $fname $lname</b><br/><br/><br/>";
		  print "<b>Thank you for shopping at Meruga's Wine Store.</b><br/><br/>";
		  print "<b>A confirmation email has been sent to : $email</b><br/><br/>";
		  print "<b>The Summary of current order is as follows:</b><br/><br/><br/><br/>";
		  
		  if($shmethod == "fast"){
		  print "<b>You have choosen Over Night shipping, which costs \$10.00. It may take 1 business day to arrive.</b><br/><br/>";
		  $strMailbody .= "<b>You have choosen Over Night shipping, which costs \$10.00. It may take 1 business day to arrive.</b><br/><br/>";
		  }else{
		   print "<b>You have choosen normal shipping, It may take 3 business day to arrive.</b><br/><br/><br/>";
		   $strMailbody .= "<b>You have choosen normal shipping, It may take 3 business day to arrive.</b><br/><br/><br/>";
		  }
		  
		  print "<b>The Order shipped to :</b><br/><br/><br/>";
		  print "<b>$address</b><br/>";
		  print "<b>$city $state</b><br/>";
		  print "<b>$zip</b><br/><br/><br/><br/><br/>";
		  
		  $strMailbody .= "<b>The Order shipped to :</b><br/><br/><br/>";
		  $strMailbody .= "<b>$address</b><br/>";
		  $strMailbody .= "<b>$city $state</b><br/>";
		  $strMailbody .= "<b>$zip</b><br/><br/><br/><br/><br/>";
		  
		  
		  
		  
	 			$cart = $_SESSION["cart"];
				$totalcost = 0;
				$totalitems =0;
				
				
				print "<table width='834' height='23' border='0'>";
				$strMailbody .="<table width='834' height='23' border='1'>";
				
				print "<tr>";
				print "<th width='104' align='center'><span class='title'>Quantity</span></th>";
				print "<th width='203' align='center'><span class='title'>Wine</span></th>";
				print "<th width='99' align='center'><span class='title'>Unit Price</span></th>";
				print "<th width='247' align='center'><span class='title'>Total</span></th>";
				print "</tr>";
				
				$strMailbody .= "<tr>";
				$strMailbody .= "<th width='104' align='center'><span class='title'>Quantity</span></th>";
				$strMailbody .= "<th width='203' align='center'><span class='title'>Wine</span></th>";
				$strMailbody .= "<th width='99' align='center'><span class='title'>Unit Price</span></th>";
				$strMailbody .= "<th width='247' align='center'><span class='title'>Total</span></th>";
				$strMailbody .= "</tr>";
				
				foreach ($cart as $id => $value) {
				
				if($cart[$id] != 0){
					$costquery = mysql_query ("SELECT  wi.winery_name, w.year, w.wine_name, w.wine_id, i.cost FROM wine w, winery wi, inventory i WHERE w.winery_id = wi.winery_id AND w.wine_id = i.wine_id and w.wine_id = $id", $connection);
					
					while ($row = mysql_fetch_array($costquery))   {
						$cyear = $row['year'];
						$cwine_name = $row['wine_name'];
						$cwinery_name = $row['winery_name'];
						$ccost = $row['cost'];
						
						print "<tr>";
						$strMailbody .= "<tr>";
						$totalitems = $totalitems + $cart[$id];
						print "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $cart[$id]</td>";
						$strMailbody .="<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $cart[$id]</td>";
						print "<td> $cyear&nbsp;&nbsp;$cwine_name&nbsp;&nbsp;$cwinery_name</td>";
						$strMailbody .="<td> $cyear&nbsp;&nbsp;$cwine_name&nbsp;&nbsp;$cwinery_name</td>";
						print "<td align='center'> \$$ccost </td>";
						$strMailbody .="<td align='center'> \$$ccost </td>";
						$tcost = $ccost * $cart[$id];
						print "<td align='center'> \$$tcost </td>";
						$strMailbody .= "<td align='center'> \$$tcost </td>";
						print "</tr>";
						$strMailbody .="</tr>";
						$totalcost = $totalcost + $tcost;
					}
					}
					else{
					unset($cart[$id]);
					}
				}
				
				$shcost = 0;
				$tax = 10;
				if($shmethod == "fast")
				 $shcost = 10;
				
				$strMailbody .= "</table>";
				print "<tr>";
				print "<td>&nbsp;</td>";
				print "</tr>";
				print "<tr>";
				print "<td>&nbsp;</td>";
				print "</tr>";
				print "<tr>";
				print "<td>&nbsp;</td>";
				print "</tr>";
				
				print "<tr>";
				print "<td><b>Total Items Cost : \$$totalcost</b></td>";
				$strMailbody .= "<p><b>Total Items Cost : \$$totalcost</b><p>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print "</tr>";
				print "<tr>";
				print "<td><b>Shipping Cost: \$$shcost</b></td>";
				$strMailbody .= "<p><b>Shipping Cost: \$$shcost</b></p>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print "</tr>";
				print "<tr>";
				print "<tr>";
				print "<td><b>Tax: \$$tax</b></td>";
				$strMailbody .="<p><b>Tax: \$$tax</b></p>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print "</tr>";
				print "<tr>";
				$grandtotal = $totalcost + $shcost + $tax;
				print "<td><b>Grand Total : \$$grandtotal</b></td>";
				$strMailbody .="<p><b>Grand Total : \$$grandtotal</b></p>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print "</tr>";
				
				
				print "<tr>";
				print "<td>&nbsp;</td>";
				print "</tr>";
				print "<tr>";
				print "<td>&nbsp;</td>";
				print "</tr>";
				
				print "<tr>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print"<td>&nbsp;</td>";
				print"<td><span class='title'><u><a href='user.php'>Click Here</a></u> To search for more wines.</span></td>";
				print "</tr>";
				
				
				print "</table>";
				
				$strMailbody .="<p>Thank You,<br/>		Sales Team,<br/>Meruga's Wine Store.</p>";					   
			    mail($strTo,$strSub,$strMailbody,"Content-type: text/html; charset=us-ascii");
				unset($_SESSION["cart"]);
				
			}
			else
			{
		      print("<span class='title'>Cart Is Empty <u><a href='user.php'>Click Here</a></u> To add some items.</span>");
		  	}
		  ?>
</body>
</html>