
//Page elements definition

var tblElmntHdr = "divElmnt|tblHdr|table";

var tblElmntMnu = "divElmnt|tblMnu|table";

var tblElmntCntr = "divElmnt|tblCntr|table";

var tblElmntFtr = "divElmnt|tblFtr|table";

function buildMainLayoutDefString() {

//alert(" Message line : buildLayoutDefString");

var elmntDef = "";

elmntDef = tblElmntHdr + "||" + tblElmntMnu + "||" + tblElmntCntr + "||" + tblElmntFtr;

elmntDef = elmntDef + "||" + "tblHdr|hdrRow|tr";

elmntDef = elmntDef + "||" + "tblMnu|mnuRow|tr";

elmntDef = elmntDef + "||" + "tblCntr|dynaRow|tr";

elmntDef = elmntDef + "||" + "tblFtr|ftrRow|tr";

bindElmntDef(2,elmntDef);
}

function funcBindURLParam(paramArr,paramVal) {
var arr = paramArr.split(",");
var res = "";
for (i = 0; i < arr.length; i++) {
  param = arr[i];
  if (i==0) {
     res = "?"+ param.split("~")[1] + "=" + paramVal[i] + "";
  } else {     
     res = res +"&"+ param.split("~")[1] + "=" + paramVal[i] + "";
  }
}
res = res.trim();
return res;
} // end func

function funcConfirmNavigation() {

rowCnt = getCounter();

//alert("Session count - " + rowCnt);

var result = "continue";

if (rowCnt == 0) {
//skip
} else {
//alert(
var res = confirm("Click cancel to leave without saving the changes done - else click yes and continue with save click to commit the changes");
  if (res == true) {
    result = "stopNavigation";
  } else {    
    //alert("Continue without saving changes");
    resetCounter();
  }
}
return result;
} // end function

function funcToggleDivHomenContext(mnuVal,txtVal) {

var result = funcConfirmNavigation();

if (result == "continue") {
var homeFrm = document.getElementById("imgDiv");
var admFrm = document.getElementById("admDiv");

homeFrm.style.display = "none";
admFrm.style.display = "none";

if (mnuVal == "home") {
homeFrm.style.display = "block";
} else if (mnuVal == "contact") {
//skip
} else if (mnuVal == "admin" || mnuVal == "login" || mnuVal == "usracct" || mnuVal == "usrchgpwd" || mnuVal == "track") {
admFrm.style.display = "block";
} else {
//skip
} //end if

funcInvoke(mnuVal,txtVal);

} // if result == continue
return result;

} // end func

function funcInvoke(mnuVal,txtVal) {

switch (mnuVal) {
case "login":
case "usracct":
case "usrchgpwd":
funcShowAdminFrame(mnuVal,txtVal);
break;
case "admin":
funcShowAdminFrame(mnuVal,txtVal);
break;
case "track":
funcShowAdminFrame(mnuVal,txtVal);
break;
//funcAssignCntxtData(txtVal);
//funcShowStockForm(txtVal);
break;
case "register":
//funcAssignCntxtData(txtVal);
break;
case "contact":
//funcAssignCntxtData(mnuVal);
break;
default:
//skip
} // switch case
} // end func


function readContextData() {

//alert(" Message line : readContextData");

buildMainLayoutDefString();

buildLayoutAttrDefString();

bindHeaderLayout();

bindMenuLayout();

bindCenterLayout();

bindFooterLayout();

bindAdminLayout();

var usrName = "guest|user|no";
funcToggleDivHomenContext("home",usrName);

/*
document.getElementById("hdrTxt").innerHTML = "Hello";
*/

} // end func readContextData()

function bindElmntDef(arrCnt,elmntDef) {

//alert(" Message line : bindElmntDef");

var arrIndx = 0;
var objArr = "";

if (objArr == null || objArr == undefined) {
arrIndx = 0;
} else {
arrIndx = (objArr.length-1);
} 

if (arrCnt == 1) {

//alert(" Message line : bindElmntDef - arrCnt - 1");

arrIndx = arrIndx + 1;
bindElmntNodes(elmntDef);

} else if (arrCnt > 1) {

//alert(" Message line : bindElmntDef - arrCnt : " + arrCnt);

//alert(" Message line : bindElmntDef - elmntDef : " + elmntDef);
objArr = elmntDef.split("||");

//alert(" Message line : bindElmntDef - objArr: " + objArr.length);

for (var i=0; i < objArr.length; i++) {

arrIndx = arrIndx + 1;
bindElmntNodes(objArr[i]);

}//for i 

}else {

alert("invalid string");

}//if arrCnt == 1 or greater than 1 else invalid

}// end func


function bindElmntNodes(elmntDef) {

//alert(" Message line : bindElmntNodes");
var strVal = elmntDef.split("|");
var parentID = strVal[0];
var nodeID = strVal[1];
var nodeName = strVal[2];

var node = document.createElement(nodeName);
node.setAttribute("id", nodeID);

tempX = document.getElementById(parentID);

if (tempX == null || tempX == undefined) {
//alert("invalid object");
alert("invalid object - " + parentID + " - node - " + nodeName);
} else {

tempX.appendChild(node);
//alert(" Message line : bindElmntNodes : " + node + " : " + node.id + " : " + tempX.id);
} // if parent node null exit else append child node

} // end func

