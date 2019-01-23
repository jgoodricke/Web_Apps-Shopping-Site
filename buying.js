/*
Name: 			James Goodricke
ID:				101082494
Description:	Scripts for the buying page
*/

//Gets the XML file from the server.
function getDoc()
{
	var url = "buying-getDoc.php";	//Path to PHP file
	
	//Create XHR Object
	var xhrObject = createXhrObject();
	if (xhrObject.overrideMimeType)
	{
		xhrObject.overrideMimeType("text/xml");		
	}

	xhrObject.open("POST", url, true);	
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			var dom = xhrObject.responseXML;
			displayCatalogue(dom);
		}
	}
	xhrObject.send(null);	
}

//Displays the catalogue table
//NOTE: It would be more efficient to construct the table using html tags rather than doing it like this.
function displayCatalogue(doc)
{
	var table = document.getElementById("catalogue");
	var goodsList = doc.getElementsByTagName("good");
	
	//Remove old table
	while(table.rows.length > 1) {
		table.deleteRow(table.rows.length - 1);
	}	
	
	for (var i=0; i < goodsList.length; i++)
	{
		//Get current node
		var good = goodsList[i];
		
		//Get Quantity Available
		var quantity = good.getElementsByTagName("available")[0].firstChild.nodeValue;
		
		//If the item is available, add it to the table
		if(quantity > 0)
		{
			//Get Values
			var itemNo = good.getElementsByTagName("itemNo")[0].firstChild.nodeValue;
			var name = good.getElementsByTagName("name")[0].firstChild.nodeValue;
			var price = good.getElementsByTagName("price")[0].firstChild.nodeValue;
			var description = good.getElementsByTagName("desc")[0].firstChild.nodeValue;
			description = description.substring(0,20);
			
			//create Button html
			var btn = "<input type='button' onclick='addToCart(" + itemNo + ")' value='add one to cart'>";
			
			//Insert row into table
			var row = document.getElementById("catalogue").insertRow(-1);
			var cell_0 = row.insertCell(0);
			var cell_1 = row.insertCell(1);
			var cell_2 = row.insertCell(2);
			var cell_3 = row.insertCell(3);
			var cell_4 = row.insertCell(4);
			var cell_5 = row.insertCell(5);
			
			//Insert Cells into rows
			cell_0.innerHTML = itemNo;
			cell_1.innerHTML = name;
			cell_2.innerHTML = description;
			cell_3.innerHTML = price;
			cell_4.innerHTML = quantity;
			cell_5.innerHTML = btn;
		}
	}
}

//Adds an item to the cart
function addToCart(itemNo)
{
	var url = "buying-addToCart.php" + "?itemNo=" + itemNo;

	var xhrObject = createXhrObject();
	xhrObject.open("GET", url, true);	
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			response = xhrObject.responseText;
			//If PHP response is blank, render cart. Otherwise, show returned error
			if(response == "")	{
				getDoc();
				displayCart();
			}
			
			document.getElementById("result").innerHTML = response;
		}
	}
	xhrObject.send(null);	
}

//Removes an item from the cart
function removeFromCart(itemNo)
{
	var url = "buying-removeFromCart.php" + "?itemNo=" + itemNo;

	var xhrObject = createXhrObject();
	xhrObject.open("GET", url, true);
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			response = xhrObject.responseText;
			//If PHP response is blank, render cart. Otherwise, show returned error
			getDoc();
			displayCart();
			document.getElementById("result").innerHTML = response;
		}
	}
	xhrObject.send(null);		
}

//Finalises the customer's purchase
function confirmPurchase()
{
	var url = "buying-confirm.php";	//PHP path
	
	//Create XHR object
	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			getDoc();
			displayCart();
			document.getElementById("result").innerHTML = xhrObject.responseText;
		}
	}
	xhrObject.send(null);			
}

//Cancels the customer's purchase
function cancelPurchase()
{
	var url = "buying-cancelPurchase.php";
	
	//Creat XHR Object
	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			response = xhrObject.responseText;
			getDoc();
			displayCart();
			document.getElementById("result").innerHTML = response;
		}
	}
	xhrObject.send(null);			
}

//Gets the customer's cart from the server and displays it
function displayCart()
{
	var url = "buying-displayCart.php";	//path to the PHP file
	
	//Creat XHR Object
	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			document.getElementById("cart").innerHTML = xhrObject.responseText;
		}
	}
	xhrObject.send(null);		
	
}

//Runs the relevant scripts when the page loads.
function init() {
	getDoc();
	displayCart();
	setInterval('getDoc()', 10000);
}