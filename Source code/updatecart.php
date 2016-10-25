<?php   
   session_start();
   $empty = $_REQUEST["emptycart"];

   if($empty == "true")
   {
	   unset($_SESSION["cart"]);
   }
   else
   {
   
   if (isset($_SESSION["cart"])){
		$cart = $_SESSION["cart"];

		foreach ($_REQUEST as $id => $value) {
			if(is_numeric($id)){
				$cart[$id] = $_REQUEST[$id];
			}
		}

		$_SESSION["cart"] = $cart;
		
	 }
   }
	header("Location:http://cs99.bradley.edu/~jmeruga/winestore/viewcart.php");
?>
