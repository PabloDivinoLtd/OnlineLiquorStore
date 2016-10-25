// validations.js
function validate_name(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert(alerttxt);return false}
		else {return true}
	}
}
function validate_zip(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter Zip Code");return false}
		if ( ! isInteger( value ))
		{ 
        alert( "Please enter a number for zip code" );
        return false;
		}
		
		if (value.length < 5) 
			{alert(alerttxt);return false}
		else {return true}
	}
}
function validate_mobile(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter Mobile Number");return false}
		if ( ! isInteger( value ))
		{ 
        alert( "Please enter a number for mobile number" );
        return false;
		}
		
		if (value.length < 10) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_email(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter Email");return false}
		apos=value.indexOf("@")
		dotpos=value.lastIndexOf(".")
		if (apos<1||dotpos-apos<2) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_cardnumber(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter Credit Card Number");return false}
		if ( ! isInteger( value ))
		{ 
        alert( "Please enter a number for credit card" );
        return false;
		}
		
		if (value.length < 16) 
			{alert(alerttxt);return false}
		else {return true}
	}
}
function validate_month(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter Month");return false}
		if ( ! isInteger( value ))
		{ 
        alert( "Please enter a number for Month" );
        return false;
		}
		
		if (value.length < 2) 
			{alert(alerttxt);return false}
		else {return true}
	}
}
function validate_year(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter Year");return false}
		if ( ! isInteger( value ))
		{ 
        alert( "Please enter a number for Year" );
        return false;
		}
		
		if (value.length < 4) 
			{alert(alerttxt);return false}
		else {return true}
	}
}
			
function validate_form(thisform)
{
	with (thisform)
	{
		
		if (validate_name(fname,"Enter First Name!")==false)
			{fname.focus();return false}
		if(validate_name(lname,"Enter Last Name")==false)
			{lname.focus();return false}
		if (validate_name(address,"Enter Address")==false)
			{address.focus();return false}
		if (validate_name(city,"Enter city")==false)
			{city.focus();return false}
		if (validate_zip(zip,"Zip code should contain 5 digits")==false)
			{zip.focus();return false}
		if (validate_mobile(mobile,"Mobile number should contain 10 digits ")==false)
			{mobile.focus();return false}
		if (validate_email(email,"Invalid format of email")==false)
			{email.focus();return false}
		if (validate_cardnumber(cardnumber,"Creditcard should contain 16 digits")==false)
			{cardnumber.focus();return false}
		if (validate_month(month,"Month should be 2 digits long")==false)
			{month.focus();return false}
		if (validate_year(year,"year should be 4 digits long")==false)
			{year.focus();return false}							
			
	}
}

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

function isInteger ( value ) {
    return ( value == parseInt( value ) );
}


function validate_sellform(thisform)
{
	with (thisform)
	{
		if (validate_name(itemname,"Enter Mobile Name(Model)!")==false)
			{itemname.focus();return false}
		if(validate_name(desc,"Enter Description")==false)
			{desc.focus();return false}
		if (validate_price(price,"Item is too costly, price should be less than 1000$")==false)
			{price.focus();return false}
		if(validate_file(filename,"File name should end with .jpg/.gif ")==false)
			{filename.focus();return false}
		if(validate_file(file,"Select a jpeg/gif image")==false)
			{file.focus();return false}
		if (validate_email(email,"Invalid format of email")==false)
			{email.focus();return false}
	}
}
function validate_price(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter Price");return false}
		if ( ! isInteger( value ))
		{ 
        alert( "Please enter a number for price" );
        return false;
		}
		
		if (value.length > 4) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_file(field,alerttxt)
{
	with (field)
	{
		if(value.length==0)
			{alert("Enter File Name");return false}
		if (value.substring(value.length-4).toLowerCase() != ".jpg" && value.substring(value.length-4).toLowerCase() != ".gif")
		{ 
        alert(alerttxt);
        return false;
		}
		
	}
}

