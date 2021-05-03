<!DOCTYPE html>
<html>
<head>

<title> NotFlix - Video Streaming Cloud Solution</title>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link id="NotFLIXcss" rel="stylesheet" href="src/css/gobalCSS.css">

<script src="context/loadPageContext.js"></script>

<script src="src/js/colorLayout.js"></script>

<script src="src/js/mainLayout.js"></script>
<script src="src/js/pageLayout.js"></script>

<script src="src/js/headerLayout.js"></script>
<script src="src/js/adminLayout.js"></script>
<script src="src/js/menuLayout.js"></script>
<script src="src/js/menuEvent.js"></script>
<script src="src/js/centerLayout.js"></script>
<script src="src/js/footerLayout.js"></script>

</head>
<?php
include 'src/php/connsrvr.php';

$rootDir = $config["rootpath"];
$siteUrlVal = siteURL();
?>
<script>

//var siteWrkDir = "notflix";
var siteWrkDir = '<?php echo $rootDir ?>';
var strUrlVal = '<?php echo $siteUrlVal ?>';

window.onunload = function () {
sessionStorage.clear();
}

window.onload = loadScriptFilesDynOnLoad();

function onUserChanged(logMode) {
var valX = "";
var elmntX = "";
elmntX = document.getElementById("lblUsrType");
//elmntX.value = "";
var divX = document.getElementById("divUsr");
divX.style.display = "none";
var divY = document.getElementById("divUsrMnu");
divY.style.display = "none";
var tempX = document.getElementById("lblUsrName");
var tempL = document.getElementById("lblGreet");
//alert(tempL);
tempL.style.display = "none";
//var tempY = document.getElementById("spanUsr");
//tempY.innerHTML = "";
var tempZ = document.getElementById("mnuAdmin");
tempZ.style.display = "none";
var tempU = document.getElementById("mnuTrack");
tempU.style.display = "none";
var tempV = document.getElementById("lblUsrID");
//tempV.value = "";

if (logMode == "loginit") {
elmntX.value = "guest|guest|no";
} else {
//skip
}// if logMode == init

valX = elmntX.value;
var arr = valX.split("|");
if (arr == null || arr == undefined || arr == "") {
//skip
} else {
if (arr[0] == "guest") {
//skip
} else {

divX.style.display = "block";
//tempX.value = arr[0];
tempX.innerHTML = arr[0];
//strVal = arr[0].substr(0, 1).toUpperCase();
//tempY.innerHTML = strVal;
tempU.style.display = "block";
tempL.style.display = "block";
if (arr[1] == "user") {
//skip
} else {
tempZ.style.display = "block";
} //if arr[1] == user

} //if arr[0] == guest

} // arr null

} // end func


function initLoadEvent() {

//alert(" Message line : initLoadEvent");

//read data from the txt files and append to a object - objContextData
readContextData();

} //end func initLoadEvent

function funcInit() {

initLoadEvent();

//var strColor = "green";
var strColor = "red";
toggleColorOnclick(strColor);

if(typeof(Storage) !== "undefined") {
sessionStorage.clickcount = 0;
/*
if (siteWrkDir == "") {
sessionStorage.siteDomainName = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/";
} else {
sessionStorage.siteDomainName = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/" + siteWrkDir + "/";
}
*/
sessionStorage.siteDomainName = strUrlVal;
sessionStorage.clrSelected = strColor;
}
onUserChanged("loginit");
//alert(sessionStorage.siteDomainName);
//alert(sessionStorage.clrSelected);
}

function getCounter() {
var rowCnt = 0;
if (sessionStorage.clickcount) {
rowCnt = sessionStorage.clickcount;
} else {
rowCnt = 0;
}
return rowCnt;
} // end func

</script>
<body id="frm" onload="funcInit()">

<center>
<div id="divElmnt">

</div>

</center>

</body>
</html>