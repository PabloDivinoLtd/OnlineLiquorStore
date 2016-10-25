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
		<script src='validations.js' type='text/javascript'></script>
</head>
<body>
<h1 align="center"> Finalise Your Order</h1>
<br><br><br>
<form action='processorder.php' method ='get' onSubmit='return validate_form(this)'>
		  <table width='603' border='0'>
			<tr>
			<td width='234' height='55'><strong><span class="title">Enter Shipping Address:</span></strong> </td>
			<td width='359'>&nbsp;</td>
			</tr>
			<tr>
			<td><span class="brand">Title:</span></td>
			<td><label>
			<select name='title'><option selected>Mr.</option><option>Mrs.</option><option>Ms.</option><option>Dr.</option>
			</select>
			</label></td>
			</tr>
			<tr>
			<td><span class="brand">First Name :</span> </td>
			<td><input type='text' name='fname' /></td>
			</tr>
			<tr>
			<td><span class="brand">Last Name:</span> </td>
			<td><input type='text' name='lname' /></td>
			</tr>
			<tr>
			<td><span class="brand">Address:</span></td>
			<td><textarea name='address'></textarea></td>
			</tr>
			<tr>
			<td><span class="brand">City:</span></td>
			<td><input type='text' name='city' /></td>
			</tr>
			<tr>
			<td><span class="brand">State:</span></td>
			<td><select name='state'><option value='AL'>Alabama</option>option value='AK'>Alaska</option><option value='AZ'>Arizona</option><option value='AR'>Arkansas</option><option value='CA'>California</option><option value='CO'>Colorado</option><option value='CT'>Connecticut</option><option value='DE'>Delaware</option><option value='FL'>Florida</option><option value='GA'>Georgia</option><option value='HI'>Hawaii</option><option value='ID'>Idaho</option><option value='IL'>Illinois</option><option value='IN'>Indiana</option><option value='IA'>Iowa</option><option value='KS'>Kansas</option><option value='KY'>Kentucky</option><option value='LA'>Louisiana</option><option value='ME'>Maine</option><option value='MD'>Maryland</option><option value='MA'>Massachusetts</option><option value='MI'>Michigan</option><option value='MN'>Minnesota</option><option value='MS'>Mississippi</option><option value='MO'>Missouri</option><option value='MT'>Montana</option><option value='NE'>Nebraska</option><option value='NV'>Nevada</option><option value='NH'>New Hampshire</option><option value='NJ'>New Jersey</option><option value='NM'>New Mexico</option><option value='NY'>New York</option><option value='NC'>North Carolina</option><option value='ND'>North Dakota</option><option value='OH'>Ohio</option><option value='OK'>Oklahoma</option><option value='OR'>Oregon</option><option value='PA'>Pennsylvania</option><option value='RI'>Rhode Island</option><option value='SC'>South Carolina</option><option value='SD'>South Dakota</option><option value='TN'>Tennessee</option><option value='TX'>Texas</option><option value='UT'>Utah</option><option value='VT'>Vermont</option><option value='VA'>Virginia</option><option value='WA'>Washington</option><option value='WV'>West Virginia</option><option value='WI'>Wisconsin</option><option value='WY'>Wyoming</option>
			</select>    </td>
			</tr>
			<tr>
			<td><span class="brand">Zip:</span></td>
			<td><input type='text' name='zip' size='5' maxlength='5'/></td>
			</tr>
			<tr>
			<td><span class="brand">Mobile:</span></td>
			<td><input name='mobile' type='text' size='10' maxlength='10' />
			</tr>
			<tr>
			<td><span class="brand">Email:</span></td>
			<td><input type='text' name='email' /></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td height='45'><strong><span class="title">Enter Payment Details:</span></strong></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td><span class="brand">Card Type:</span> </td>
			<td><select name='cardtype'><option selected>Visa</option><option>Master</option><option>Discover</option><option>American Express</option>
			</select>    </td>
			</tr>
			<tr>
			<td><span class="brand">Card Number:</span> </td>
			<td><input type='text' name='cardnumber' /></td>
			</tr>
			<tr>
			<td><span class="brand">Expiry Date:</span> </td>
			<td><span class="brand">Month: </span>
			<input name='month' type='text' size='5' maxlength='2' /> 
			<span class="brand">Year: </span>
			<input name='year' type='text' size='5' maxlength='4' /></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td><span class="brand">Shipping Method : </span></td>
			<td><label>
			<input type='radio' name='shmethod' value='normal' checked='true'/>
			Normal 
			<input type='radio' name='shmethod' value='fast' />
			Over Night</label></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td align="center"><input type='submit' name ='submit' value='Submit'/></td>
			<td align="center"><input type='reset' name='reset' value='Reset'/></td>
			</tr>
			</table>
		  </form>
</body>
</html>