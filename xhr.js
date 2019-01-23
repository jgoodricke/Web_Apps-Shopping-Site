/*
Name: 			James Goodricke
ID:				101082494
Description:	Code for creating an XHR Object.
*/

function createXhrObject() {
	var xhrObject = false;
	if (window.XMLHttpRequest) {
	xhrObject = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		xhrObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xhrObject;
}