<?php
 
  session_start();
 ?>

<html>
<head>
<script  type="text/javascript">
			function validate_email(field,alerttxt)
			{
				with (field)
				{
					if(value.length==0)
						{alert("Enter UserName");return false}
					apos=value.indexOf("@")
					dotpos=value.lastIndexOf(".")
					if (apos<1||dotpos-apos<2) 
						{alert(alerttxt);return false}
					else {return true}
				}
			}
			function validate_password(field,alerttxt)
			{
				with (field)
				{
					if(value.length==0)
						{alert("Enter Password");return false}
					if(value.length < 6)
						{alert("Password length must be greater than 6 chars");return false}
					for(var i=0;i<value.length;i++){
						var ch=value.charAt(i);
						if(!((ch>='a'&&ch<='z')||(ch>='A'&&ch<='Z')||(ch>='0'&&ch<='9')))
						{alert(alerttxt);return false}
					}
					return true;
				}
			}

			function password_match(field,field1,alerttxt)
			{
				if(field.value < 6)
						{alert("Password length must be greater than 6 chars");return false}
				if(field.value != field1.value)
				{
				alert(alerttxt);
				return false;
				}
				return true;
			}

			
			function validate_form(thisform)
			{
				with (thisform)
				{
					
					if (validate_email(username,"Invalid format of email in UserName !")==false)
						{username.focus();return false}
					if(validate_password(password,"Invalid Characters in Password")==false)
						{password.focus();return false}
					if(password_match(password,repass,"Pasword does not match")==false)
						{password.focus();return false}
										
						
				}
			}
		</script>
</head>
<body>
<center>
<?php
				 if (isset($_SESSION["registerfailed"])){
				 	if($_SESSION["registerfailed"] == "true"){
					    $message = $_SESSION["regErrorMsg"];
				 		print "<br><br><font color='red'>$message</font>";
						}
				 }
				 
				 ?>
				</center>
<form action="registerdb.php" method="get" onsubmit="return validate_form(this)">
                  <table width="100%" height="123" border="0">
                  <tr>
                    <td width="4%">&nbsp;</td>
                    <td width="38%"><span class="title">User ID(Email):</span></td>
                    <td width="58%"><input type="text" name="username" /></td>
                  </tr>
                  <tr>
                    <td height="39">&nbsp;</td>
                    <td><span class="title">Password:</span></td>
                    <td><input type="password" name="password" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><span class="title">Retype Password :</span></td>
                    <td><input type="password" name="repass" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><p>&nbsp;</p>
                      <p>&nbsp;</p></td>
                    <td><input type="submit" name="Submit" value="Register" /></td>
                  </tr>
                </table>
		</form>
</body>
</html>