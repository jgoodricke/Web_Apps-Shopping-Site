/*
Name: 			James Goodricke
ID:				101082494
Description:	Scripts for the Processing Page
*/

//Displays table of unproccessed purchases
function getData()
{
	//PHP url
	var url = "processing-getData.php"
	
	//Create XHR Object
	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	
	
	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			document.getElementById("result").innerHTML = xhrObject.responseText;
		}
	}
	xhrObject.send(null);	
}

//Processes outstanding purchases
function process()
{
	//PHP url
	var url = "processing-process.php"

	//Create XHR Object
	var xhrObject = createXhrObject();
	xhrObject.open("POST", url, true);	

	//Do Query
	xhrObject.onreadystatechange = function() {
		if(xhrObject.readyState == 4 && xhrObject.status == 200) {
			//If debugging show output, otherwise reload data.
			document.getElementById("debugging").innerHTML = xhrObject.responseText;
			
			getData();					
		}
	}
	xhrObject.send(null);	
}
