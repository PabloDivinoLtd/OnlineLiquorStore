<?php   
   session_start();
   
   $wine_id = $_REQUEST["wine_id"];
   $no = $_REQUEST["no"];
   $search = $_REQUEST["search"];
   $region = $_REQUEST["region"];
   $winetype = $_REQUEST["winetype"];
   $cart = array();
  
   $connection = mysql_connect("cs99.bradley.edu","s_jmeruga","dingdong");   
   mysql_select_db("s_jmeruga", $connection);
   $result = mysql_query ("select w.wine_id, i.cost from wine w,inventory i where w.wine_id=i.wine_id and w.wine_id=$wine_id", $connection);

    if (isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];
	 }
	 else{
		 $_SESSION["cart"] = $cart;
	 }

    	if($cart[$wine_id])
		 {
			$cart[$wine_id] = $cart[$wine_id] + $no;
		 }
		 else
		 {
			 $cart[$wine_id] = $no;
		 }
		
	 $_SESSION["cart"] = $cart;
	 
	 if($search == "true"){
		 header("Location:http://cs99.bradley.edu/~jmeruga/winestore/user.php?search=$search&region=$region&winetype=$winetype");
	 }
	 else{
		header("Location:http://cs99.bradley.edu/~jmeruga/winestore/user.php");
	 }
	   
	 ?>
