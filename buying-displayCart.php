<?php
/*
Name: 			James Goodricke
ID:				101082494
Description:	Displays the customer's cart on the buying page.
*/
	//Start Session
	session_start();
	//path to xml file
	$xmlFile = "../../data/goods.xml";
	
	$result = "";
	
	//Check if cart exists
	if (isSet($_SESSION["cart"]))
	{
		//Check if file exists and cart contains at least one item
		if (count($_SESSION["cart"]) != 0 && file_exists($xmlFile))
		{
			//Get DomDocument from XML file
			$dom = DOMDocument::load($xmlFile);
			$root = $dom->getElementsByTagName("good");
			
			//Add Cart Heading and Table Header
			$result = $result."<h2>Shopping Chart</h2>";
			$result = $result."<table> <tr> <th>Item Number</th> <th>Price</th> <th>Quantity</th> <th>Remove</th> </tr>";
			
			//Total Price of Cart
			$total=0;
			
			//Cart Buttons
			$confirmButton = "<button onclick='confirmPurchase();'>Confirm Purchase</button>";
			$cancelButton = "<button onclick='cancelPurchase();'>Cancel Purchase</button>";
			$buttonSpace = "&nbsp; &nbsp; &nbsp; &nbsp;";
			
			foreach ($_SESSION["cart"] as $itemNo => $amount)
			{
				foreach($root as $node)
				{
					//Get item number for node
					$currentItemNo = $node->getElementsByTagName("itemNo")->item(0)->nodeValue;
					
					//If the item numbers match, get the price from node and calculate price
					if($itemNo == $currentItemNo)
					{
						$price = $node->getElementsByTagName("price")->item(0)->nodeValue;
						
						$total = $total + ($price * $amount);
						
						break;
					}
				}
				//Remove from cart button
				$removeButton = "<button onclick='removeFromCart(".$itemNo.")'>Remove from Cart</button>";
				
				//Add new row
				$result = $result."<tr> <td>".$itemNo."</td> <td>".$price."</td> <td>".$amount."</td> <td>".$removeButton."</td> </tr>";
				
			}
			//Add Total Price
			$result=$result."<tr> <td colspan='3' style='text-align: left;'>Total: </td> <td>".$total."</td> <tr>";
			
			//Add Buttons
			$result=$result."<tr  id='buttons'> <td colspan='4' style='text-align: center;'>".$confirmButton.$buttonSpace.$cancelButton."</td> <tr>";
			
			//Closing table tag
			$result = $result."<table>";
		}
	}
	echo $result;
?>