
window.onclick = function(event) {
var divX = document.getElementById("prfDiv");
  if (event.target == divX) {
     divX.style.display = "none";
  }
}

function onLogoutClick() {

elmntX = parent.document.getElementById("lblUsrType");
var usrInfo = elmntX.value;

var arr = usrInfo.split("|");
var usrName = arr[0];
if (usrName != "guest") {
elmntX.value = "guest|guest|no";
parent.onUserChanged("logged");
var msgVal = "msg|You have successfully logout|no";
var urlPath = sessionStorage.siteDomainName;
//document.write(urlPath + "<br><br>");
//var urlFile = "php-srcFiles/phpWelcome.php?usrMsg=" + msgVal;
var urlFile = "src/php/Welcome.php?usrMsg=" + msgVal + "&mnuOpt=login";
//document.write(urlFile + "<br><br>");
//var hrefVal = urlPath + "/" + urlFile;
var hrefVal = urlPath + urlFile;
//document.write(hrefVal + "<br><br>");

window.location.href = hrefVal;
} else {
//skip
}
}// end func

function bindAuditLogData() {

var tempX = document.getElementById("prfLblUsrID");
//alert(tempX);
var usrID = tempX.innerHTML;
//alert(usrID);

var tempY = parent.document.getElementById("lblLogID");
var logID = tempY.value;

var valArr = "";
var valArr = document.getElementsByName("idVal[]");
maxVal = funcGetMaxVal(logID,false);
valArr[0].value = maxVal;
//tempY.value = maxVal;

var valArr = document.getElementsByName("dbVal[]");
valArr[0].value = "UserAcct|Edit|yes";

var valArr = document.getElementsByName("keyVal[]");
valArr[0].value = "keyVal|UserAcctID|" + usrID;

var valArr = document.getElementsByName("updateVal[]");
var valX = valArr[0].value;
var valZ = valX + "~" + valX;
//alert(valZ);
valArr[0].value = valZ;
}

function bindAuditLogStringConcat(colName,oldVal,newVal) {
var valArr = document.getElementsByName("updateVal[]");
//alert(valArr.length);
var valX = valArr[0].value;
var valZ = "";
if (oldVal == "") {
oldVal = "NA";
}
if (newVal == "") {
newVal = "NA";
}
if (oldVal == newVal) {
//skip
} else {
if (valX == "NA" || valX == "") {
valX = colName + "|" + oldVal + "|" + newVal;
} else {
valX = valX + "||" + colName + "|" + oldVal + "|" + newVal;
}
}
valArr[0].value = valX;
}

function checkForm(dbX,strMode,strFrm) {
var blnValidFrm = true;
var frmEdited = false;

validate: {
if (strFrm == "prfAcct") {
//testingData - 'UserEmail|usertest@gmail.com|user1@gmail.com'

tempX = document.getElementById(dbX + "LastName" + "-tmp");
tempY = document.getElementById(dbX + "LastName");
if(chkValidName(tempY,false,30,"Last name") == false) {
blnValidFrm = false;
break validate;
} else {
//skip
}

if(tempY.value == tempX.innerHTML) {
//skip
} else {
frmEdited = true;
bindAuditLogStringConcat("LastName",tempX.innerHTML,tempY.value);
}

tempX = document.getElementById(dbX + "UserEmail" + "-tmp");
tempY = document.getElementById(dbX + "UserEmail");
if (chkCharLength(tempY,40,"User email") == false) {
blnValidFrm = false;
break validate;
}

if(chkValidEmail(tempY,true) == false) {
blnValidFrm = false;
break validate;
} else {
//skip
}

if(tempY.value == tempX.innerHTML) {
//skip
} else {
frmEdited = true;
bindAuditLogStringConcat("UserEmail",tempX.innerHTML,tempY.value);
}

tempX = document.getElementById(dbX + "UserPhone" + "-tmp");
tempY = document.getElementById(dbX + "UserPhone");
if(chkValidPhone(tempY,false) == false) {
validFrm = "no";
break validate;
} else {
//skip
}

if(tempX.innerHTML == tempY.value && strMode == "Edit") {
//skip
} else {
frmEdited = true;
bindAuditLogStringConcat("UserPhone",tempX.innerHTML,tempY.value);
}

} else if (strFrm == "prfChgPwd") {

tempW = document.getElementById("prfLblUsrPwd");
tempZ = document.getElementById("txtCurrPwd");
tempX = document.getElementById("txtNewPwd1");
tempY = document.getElementById("txtNewPwd2");

if (tempW.innerHTML !== tempZ.value) {
alert("Current password invalid or wrong ");
tempZ.focus();
blnValidFrm = false;
break validate;
} 

if (chkValidPassword(tempX,true) == false) {
blnValidFrm = false;
break validate;
}

if (tempX.value == tempZ.value) {
alert("New password and current password cannot be same");
tempX.focus();
blnValidFrm = false;
break validate;
} else {
//skip
}

if(chkValidPassword(tempY,true) == false) {
blnValidFrm = false;
break validate;
} 

if(tempX.value == tempY.value) {
blnValidFrm = true;
bindAuditLogStringConcat("UserPwd",tempZ.value,tempY.value);
} else {
alert("Confirm New password and New password should be same");
tempY.focus();
blnValidFrm = false;
break validate;
}

} else {
//skip
}
}

if (blnValidFrm == true) {
bindAuditLogData();
}
return blnValidFrm;
} // end func

function onUserMnuBtnClick(strVal,strPrtID) {
var frmX = "";
var tempArr = "";
var arrInfo = "";
var rowX = "";
var rowY = "";
var colX = "";
var colY = "";
var strFrm = "";
var tmpVal = "";

//var tempX = document.getElementById(strID);

strFrm = "";
if (strVal == 'usracct') {
strFrm="prfAcct";
} else if (tempX.id == 'btnAddr') {
//strFrm="prfAddr";
} else if (strVal == 'usrchgpwd') {
strFrm="prfChgPwd";
}

//tempY = document.getElementById("div1");
tempY = document.getElementById(strPrtID);
if (tempY == null || tempY == undefined || tempY == "") {
//skip
} else {
removeAllChildNodes(tempY);
}

frmX = document.createElement("form");
frmX.setAttribute("id","frmAcct");
frmX.setAttribute("name","frmAcct");
frmX.setAttribute("style","width:100%;padding:10px;text-align:left;");
frmX.setAttribute("method","POST");
//frmX.setAttribute("style","background:pink;");
frmX.setAttribute("action","postdata.php");

var tblX = "";
tblX = document.createElement("table");
tblX.setAttribute("id","tblAcct");
//tblX.setAttribute("style","margin:20px;");
tblX.setAttribute("style","margin-left:auto;margin-right:auto;");

funcBindValToElmnt(strFrm);

//tempArr = '<?php echo $custCrdn ?>';
arrInfo = "";
arrInfo = currUsrRS;

tempArr = "";
tempArr = arrInfo.split("||");

var dbInfo = tempArr[0].split("|");
var tblCap = dbInfo[0];
var dbX = dbInfo[1];
var keyCol = dbInfo[2];
var valX = "";
var colName = "";

if (strVal == 'usracct') {

var colInfo = tempArr[1].split("|");
var colArr = "";

for (i=0;i<colInfo.length;i++) {
colArr =  colInfo[i].split("~");

rowX = "";
rowX = document.createElement("tr");

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

valX = "";
valX = colArr[0];

elmntX = "";
elmntX = document.createElement("label");
elmntX.setAttribute("id",dbX + "" + "lbl" + i);
elmntX.innerHTML = valX;

colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","3");
colX.setAttribute("style","padding:10px;text-align:left;");

colName = "";
colName = colArr[1];
//alert(colName);

var isEditable = colArr[2];
//alert(isEditable);

valX = "";
valX = colArr[4];
//alert(valX);
if (isEditable == "enable") {
elmntX = document.createElement("label");
elmntX.setAttribute("id",dbX + colName + "-tmp");
elmntX.setAttribute("style","display:none;");
elmntX.innerHTML = valX;
colX.appendChild(elmntX);
}

elmntX = document.createElement("input");
//elmntX.setAttribute("type","text");
if (colName == 'UserPwd' || colName == 'UserAdmin') {
elmntX.setAttribute("type","password");
} else {
elmntX.setAttribute("type","text");
}
elmntX.value = valX;
elmntX.setAttribute("id",dbX + colName);
elmntX.setAttribute("name",dbX + colName);

if (isEditable == "enable"){
elmntX.style.background = "#e6f5ff";
} else {
elmntX.setAttribute("readonly","readonly");
}

if (colName == 'UserPwd') {
elmntX.setAttribute("readonly","readonly");
elmntX.style.background = "transparent";
}

colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);
} // for loop

} else if (strVal == 'usrchgpwd') {

rowX = "";
rowX = document.createElement("tr");

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("label");
elmntX.innerHTML =  "UserName";
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","3");
colX.setAttribute("style","padding:10px;text-align:left;");

tmpVal = document.getElementById("prfLblUsr").innerHTML;
//alert(tmpVal);

elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","txtUserName");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value",tmpVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);

rowX = "";
rowX = document.createElement("tr");

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("label");
elmntX.innerHTML =  "Current Password";
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","3");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","password");
elmntX.setAttribute("id","txtCurrPwd");
elmntX.setAttribute("name","txtCurrPwd");
elmntX.style.background = "#e6f5ff";
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);

rowX = "";
rowX = document.createElement("tr");

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("label");
elmntX.innerHTML =  "New Password";
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","3");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","password");
elmntX.setAttribute("id","txtNewPwd1");
elmntX.setAttribute("name","txtNewPwd1");
elmntX.style.background = "#e6f5ff";
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);

rowX = "";
rowX = document.createElement("tr");

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("label");
elmntX.innerHTML =  "Confirm Password";
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","3");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","password");
elmntX.setAttribute("id","txtNewPwd2");
elmntX.setAttribute("name","txtNewPwd2");
elmntX.style.background = "#e6f5ff";
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);

} // if pageName == 'prfAcct'

rowX = "";
rowX = document.createElement("tr");
rowX.setAttribute("style","display:none;");

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","idVal[]");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value","NA");
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","keyVal[]");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value","NA");
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","dbVal[]");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value","NA");
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:left;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","updateVal[]");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value","NA");
colX.appendChild(elmntX);

rowX.appendChild(colX);
tblX.appendChild(rowX);

rowX = "";
rowX = document.createElement("tr");
//rowX.setAttribute("style","text-align:center;");

colX = "";
colX = document.createElement("td");
colX.setAttribute("style","padding:10px;text-align:center;");

elmntX = document.createElement("input");
elmntX.setAttribute("type","hidden");
elmntX.setAttribute("name","lblMnuVal");
elmntX.setAttribute("value",strVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","2");
colX.setAttribute("style","padding:10px;text-align:center;");

elmntX = "";
elmntX = document.createElement("input");
elmntX.setAttribute("type","submit");
elmntX.setAttribute("id","acctSave");
elmntX.setAttribute("name","acctSave");
elmntX.setAttribute("value","CLICK SAVE - COMMIT CHANGES");
//elmntX.setAttribute("style","disabled:true;");
elmntX.innerHTML = "CLICK SAVE - COMMIT CHANGES";
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);

frmX.appendChild(tblX);
frmX.setAttribute("onsubmit","return checkForm('" + dbX + "','Edit','" + strFrm + "')");

parentX = document.getElementById(strPrtID);
parentX.setAttribute("style","width:100%;");
parentX.appendChild(frmX);

} // end func

function funcBindValToElmnt(pageName) {

var elmntX = document.getElementById("prfH3");
var elmntY = document.getElementById("prfHdrLbl");

var pageArrAttr = "";
pageArrAttr = prfPageAttr;

//alert("Hey it works : " + pageArrAttr);
var tempArr = pageArrAttr.split("||");
var arr = "";
var strVal = "";
for (i = 0; i < tempArr.length; i++) {
  arr = tempArr[i].split("|");
  if (pageName == arr[0]) {
     elmntX.innerHTML = arr[1];
     elmntY.innerHTML = arr[2];
     break;
  }
} // for loop

} // end func

function pageContext(pageName) {

funcBindValToElmnt(pageName);

tempX = document.getElementById("div1");
removeAllChildNodes(tempX);
} // end func

function showProfileMnu() {
//funcBindValToElmnt('prfAcct');
tempX = document.getElementById("prfAcctDiv");
tempX.style.display = "block";
}

function hideProfileMnu() {
tempX = document.getElementById("prfAcctDiv");
tempX.style.display = "none";
}

function chngBgClrBtn(tempX,strVal) {
if (strVal=='mouseover') {
tempX.style.background = "#e6f5ff";
} else {
tempX.style.background = "transparent";
}
}

function removeAllChildNodes(parent) {
if (parent == null || parent == undefined || parent == "") {
//skip
} else {
if (parent.hasChildNodes()) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
} // if haschildnodes
} // if null
} // end func

function func_bindPrfFrmElmnt() {
var arrVal = "";
var parentID = "";
var nodeID = "";
var nodeName = "";

var objArr = prfElmntDef.split("||");

for (var i=0; i < objArr.length; i++) {
arrVal = objArr[i].split("|");
parentID = arrVal[0];
nodeID = arrVal[1]
nodeName = arrVal[2];

var node = document.createElement(nodeName);
node.setAttribute("id", nodeID);

tempX = document.getElementById(parentID);

if (tempX == null || tempX == undefined) {
alert("invalid object");
} else {

tempX.appendChild(node);
//alert(" Message line : func_bindElmnt : " + node + " : " + node.id + " : " + tempX.id);
} // if parent node null exit else append child node

} //for loop

var tagID = "";
var tagAttr = "";
var tagVal = "";

objArr = prfAttrDef.split("||");

for (var i=0; i < objArr.length; i++) {
arrVal = objArr[i].split("|");
tagID = arrVal[0];
tagAttr = arrVal[1];
tagVal = arrVal[2];

var elmnt = document.getElementById(tagID);
if (elmnt == null || elmnt == undefined) {
alert("invalid object");
} else {

if (tagAttr == "innerHTML") {
elmnt.innerHTML = tagVal;
} else {
elmnt.setAttribute(tagAttr, tagVal);
//alert(" Message line : func_bindElmntAttrByTag : " + elmnt.id);
} // if tagAttr 
} // elmnt is null
} // for loop

} // end func
