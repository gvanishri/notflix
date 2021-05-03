
//bind hdrRow  elements
var hdrElmntDef = "";

hdrElmntDef = "hdrRow|hdrCol01|td";
hdrElmntDef = hdrElmntDef + "||" + "hdrRow|hdrCol02|td";
hdrElmntDef = hdrElmntDef + "||" + "hdrRow|hdrCol03|td";

hdrElmntDef = hdrElmntDef + "||" + "hdrCol01|lblDisp01|label";

hdrElmntDef = hdrElmntDef + "||" + "hdrCol01|divClr|div";
hdrElmntDef = hdrElmntDef + "||" + "divClr|spanSep01|span";
hdrElmntDef = hdrElmntDef + "||" + "divClr|btnBlue|button";
hdrElmntDef = hdrElmntDef + "||" + "divClr|spanSep02|span";
hdrElmntDef = hdrElmntDef + "||" + "divClr|btnGreen|button";
hdrElmntDef = hdrElmntDef + "||" + "divClr|spanSep03|span";

hdrElmntDef = hdrElmntDef + "||" + "hdrCol01|divText|div";
hdrElmntDef = hdrElmntDef + "||" + "divText|lblTxt|label";

hdrElmntDef = hdrElmntDef + "||" + "hdrCol02|lblGreet|label";

hdrElmntDef = hdrElmntDef + "||" + "hdrCol03|divUsr|div";
//hdrElmntDef = hdrElmntDef + "||" + "divUsr|spanUsr|span";
hdrElmntDef = hdrElmntDef + "||" + "divUsr|lblUsrName|label";
//hdrElmntDef = hdrElmntDef + "||" + "divUsr|lblUsrName|input";
hdrElmntDef = hdrElmntDef + "||" + "divUsr|lblUsrType|input";
hdrElmntDef = hdrElmntDef + "||" + "divUsr|lblUsrID|input";
hdrElmntDef = hdrElmntDef + "||" + "divUsr|lblLogID|input";
hdrElmntDef = hdrElmntDef + "||" + "divUsr|lblUsrPwd|input";

var hdrAttrDef = "";
hdrAttrDef = "hdrCol01|colSpan|1;";
hdrAttrDef = hdrAttrDef + "||" + "hdrCol01|style|position:relative;width:10%;padding-top:10px;padding-bottom:10px;"; //background-color: cyan;";
//hdrAttrDef = hdrAttrDef + "||" + "hdrCol01|onmouseover|showToggleClrToolTip()";
//hdrAttrDef = hdrAttrDef + "||" + "hdrCol01|onmouseleave|hideToggleClrToolTip()";

hdrAttrDef = hdrAttrDef + "||" + "hdrCol02|colSpan|1";
hdrAttrDef = hdrAttrDef + "||" + "hdrCol02|style|width:75%;padding-top:10px;padding-bottom:10px;text-align:center;";

hdrAttrDef = hdrAttrDef + "||" + "hdrCol03|colSpan|3";
hdrAttrDef = hdrAttrDef + "||" + "hdrCol03|style|width:15%;";

hdrAttrDef = hdrAttrDef + "||" + "lblGreet|innerHTML|Welcome";

hdrAttrDef = hdrAttrDef + "||" + "divText|style|position:absolute;margin:5px;width:150px;padding:5px;z-index:1;display:none;background-color:#e6f5ff;border-radius:5px;";
hdrAttrDef = hdrAttrDef + "||" + "lblTxt|innerHTML|Click to toggle color";

hdrAttrDef = hdrAttrDef + "||" + "spanSep01|innerHTML|&nbsp;";
hdrAttrDef = hdrAttrDef + "||" + "btnBlue|style|border-radius:50%;background-color:#0099ff;outline:none;border:none;display:none;";
//hdrAttrDef = hdrAttrDef + "||" + "btnBlue|onclick|toggleColorOnclick('blue')";

hdrAttrDef = hdrAttrDef + "||" + "spanSep02|innerHTML|&nbsp;";
hdrAttrDef = hdrAttrDef + "||" + "btnGreen|style|border-radius:50%;background-color:#669999;outline:none;border:none;display:none;";
//hdrAttrDef = hdrAttrDef + "||" + "btnGrey|onclick|toggleColorOnclick('grey')";

hdrAttrDef = hdrAttrDef + "||" + "spanSep03|innerHTML|&nbsp;";

hdrAttrDef = hdrAttrDef + "||" + "divUsr|style|height:30px;padding-left:20px;background-color:transparent;border-radius:25px;display:none;";
//hdrAttrDef = hdrAttrDef + "||" + "spanUsr|class|circle";
//hdrAttrDef = hdrAttrDef + "||" + "lblUsrName|style|float:left;padding-top:5px;padding-left:10px;border:none;outline:none;background:transparent;";
hdrAttrDef = hdrAttrDef + "||" + "lblGreet|style|float:right;font-size:18px;padding-top:5px;padding-left:10px;display:none;";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrName|style|float:left;font-size:18px;padding-top:5px;padding-left:10px;";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrType|style|float:left;padding-top:5px;padding-left:10px;";
hdrAttrDef = hdrAttrDef + "||" + "lblGreet|innerHTML|Welcome";
//hdrAttrDef = hdrAttrDef + "||" + "lblUsrName|innerHTML|hello";
//hdrAttrDef = hdrAttrDef + "||" + "lblUsrName|innerHTML|hello";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrID|type|text";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrID|readonly|readonly";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrID|type|hidden";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrType|type|hidden";
hdrAttrDef = hdrAttrDef + "||" + "lblLogID|type|hidden";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrPwd|type|hidden";
hdrAttrDef = hdrAttrDef + "||" + "lblUsrType|onchange|onUserChanged()";

//hdrAttrDef = hdrAttrDef + "||" + "lblDisp03|innerHTML|&nbsp;&nbsp;&nbsp;";

function showToggleClrToolTip() {
divText.style.display = "block";
}

function hideToggleClrToolTip() {
divText.style.display = "none";
}

function onUserLogoutClick() {
elmntX = document.getElementById("lblUsrType");
//var usrInfo = elmntX.innerHTML;
var usrInfo = elmntX.value;
var arr = usrInfo.split("|");

if (arr[0] != "guest") {
var result = getCounter();
var valX = "msg|You have successfully logout|no";
if (result == 0) {
funcToggleDivHomenContext("login",valX);
} else {
//skip
} // result == 0

onUserChanged("loginit");
}  else {
//skip
} // if usrName != guest

} // end func

function funcRedirectURLPath(urlFile) {
//var urlPath = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
var urlPath = sessionStorage.siteDomainName;
//document.write(urlPath + "<br><br>");
//var urlFile = "php-srcFiles/phpWelcome.php?usrMsg=" + msgVal;
//document.write(urlFile + "<br><br>");
var hrefVal = urlPath + "/" + urlFile;
//document.write(hrefVal + "<br><br>");
window.location.href = hrefVal;
}// end func

function callHideUsrAcctMenu() {
tempX = document.getElementById("divUsr");
if (tempX.style.display == "block") {
var tempY = document.getElementById("divUsrMnu");
tempY.style.display = "none";
}
} // end func

function callShowUsrAcctMenu() {
tempX = document.getElementById("divUsr");
if (tempX.style.display == "block") {
var tempY = document.getElementById("divUsrMnu");
tempY.style.width = "200px";
tempY.style.display = "block";
}
} // end func

function bindHeaderLayout() {

//alert("function - bindHeaderLayout");

//alert("function - bindHeaderLayout : " + hdrElmntDef);

bindElmntDef(2,hdrElmntDef);

//alert("function - bindHeaderLayout : " + hdrAttrDef );

bindElmntAttrRule(2,hdrAttrDef);

hdrElmntDef="";
hdrAttrDef="";
}

