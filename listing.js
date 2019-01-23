/*
Name: 			James Goodricke
ID:				101082494
Description:	Scripts for the listing page.
*/

//Resets the text boxes.
function resetFields()
{
	document.getElementById("name").value = "";
	document.getElementById("price").value = "";
	document.getElementById("quantity").value = "";
	document.getElementById("description").value = "";
}

//Add a listing to goods.xml
function addListing()
{
	//Get values from fields
	var name = document.getElementById("name").value;
	var price = document.getElementById("price").value;
	var quantity = document.getElementById("quantity").value;
	var desc = document.getElementById("description").value;
	
	//--------------
	//Validate Input
	//--------------
	var error = "";
	//If some fields blank, show an error
	if(name == "" || price == "" || quantity == "" || desc == "")
	{
		error = "Error: some fields are blank";
	}	
	
	//If quantity or price fields don't contain only numbers, show an error
	else if( !(price.match(/^\d+$/) && quantity.match(/^\d+$/)) )
	{
		
		error = "Error: Price and quantity fields can only contain a number";
	}

	//If errors exist, output error message
	if(error != "")
	{
		document.getElementById("result").innerHTML = error;
	}
	
	//If no errors, send to server
	else
	{
		//Generate PHP URL
		var url = "listing-addListing.php"
		url = url + "?name=" + name + "&price=" + price + "&quantity=" + quantity + "&desc=" + desc;
		
		//Generate XHR Object
		var xhrObject = createXhrObject();
		xhrObject.open("GET", url, true);	
		
		//Do Query
		xhrObject.onreadystatechange = function() {
			if(xhrObject.readyState == 4 && xhrObject.status == 200) {
				document.getElementById("result").innerHTML = xhrObject.responseText;
			}
		}
		xhrObject.send(null);	
	}
}