/* 
 * Provides ajax tools for ACWPD Projects
 * Feel free to use this in your projects! Just provide Attribution by keeping this block in place!
 * 
 * This is version 1.0
 * 
 * For the latest version, please visit: https://github.com/farfromunique/ACWPD_Tools
 * 
 * This code is copyright (C) 2015 Aaron Coquet / ACWPD
 */ 
 
/* 
 * Instructions for preperation:
 * Replace ::SiteName:: with the string to be placed in the browser's history
 *
 */

// Put site's address here, in format "http://sub.domain.tld/path/to/root"
var sRoot = document.location.origin; // This is the default


function loadMyPage(pageName, displayURL, targetDiv) {
	var ajax;
	document.getElementById("content").innerHTML = "Loading ...";
	ajax = new XMLHttpRequest();
	ajax.open("GET", sRoot + pageName, true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState === 4) {
			document.getElementById(targetDiv).innerHTML = ajax.responseText;
		}
	};
	ajax.send(null);
	window.history.pushState({site:"::SiteName::"}, "", "/" + displayURL + "/");
}

function postToPage(pageName, displayURL, postData) {
	var ajax;
	document.getElementById("content").innerHTML = "Loading ...";
	ajax = new XMLHttpRequest();
	ajax.open("POST", sRoot + pageName, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState === 4) {
			document.getElementById("content").innerHTML = ajax.responseText;
		}
	};
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send(postData);
	window.history.pushState({site:"::SiteName::"}, "", "/" + displayURL + "/");
}

function postAndRedirect(pageName, displayURL, postData, redirectTo) {
	var ajax;
    document.getElementById("content").innerHTML = "Loading ...";
	ajax = new XMLHttpRequest();
	ajax.open("POST",sRoot + pageName, true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState === 4) {
			loadMyPage(redirectTo, displayURL, 'content');
		}
	};
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send(postData);
	window.history.pushState({site:"::SiteName::"}, "", "/" + displayURL + "/");
}

function DismissImportant() {
	if (document.getElementById('Important')) {
	document.getElementById('Important').style.display='none';
	}
}

function hideMessage() {
	if(document.getElementById('Message')) {
		document.getElementById('Message').style.display='none';
	}
}
