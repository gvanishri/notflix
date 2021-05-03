

function checkValidUser() {
var res = "0";
var result = getCounter();
if (result == 0) {
elmntX = document.getElementById("lblUsrType");
var usrInfo = elmntX.value;
var valX = usrInfo.split("|");
if (valX[0] == "guest") {
//skip
} else {
res = "1";
}
} else {
//skip
} // if result == 0
return res;
} // end func

function funcHideAdminMenu(tempX) {
//alert("Function : funcHideAdminMenu");
tempX.style.display = "none";
}

function funcShowAdminMenu(divX) {
//alert("Function : funcShowAdminMenu");
if (checkValidUser() == "1") {
divX.style.width = "100px";
//divX.style.marginLeft = "-50px";
divX.style.display = "block";
} else {
//skip
}
} // end func

function onHomeBtnClick() {
var result = getCounter();
//alert("function - onHomeBtnClick");
if (result == 0) {
funcToggleDivHomenContext("home","Hello");
}
}// end func

function funcHideLoginFrm() {
var tempX = "";
tempX = document.getElementById("divLogin");
tempX.style.display = "none";
} // end func

function funcShowLoginFrm(mnuVal) {
//alert("function - funcShowLoginFrm");
var result = getCounter();

elmntX = document.getElementById("lblUsrType");
var usrInfo = elmntX.value;

if (result == 0) {
    funcToggleDivHomenContext(mnuVal,usrInfo);
} else {
//skip
} // result == 0

} // end func

function onTrackImgClick(txtVal) {
var result = getCounter();
//alert("function - onTrackImgClick");
if (result == 0) {    
    var valX,valY,tmpX;
    tmpX = document.getElementById("lblUsrID");
    valX = tmpX.value;
    tmpX = document.getElementById("lblUsrName");
    valY = tmpX.innerHTML;
    //valY = tmpX.value;
    txtVal = valX + "|" + valY;
    funcToggleDivHomenContext("track",txtVal);
} else {
    //skip
}
}// end func

function onAdminImgClick(txtVal) {
var result = getCounter();
//alert("function - onAdminImgClick");
if (result == 0) {
    funcToggleDivHomenContext("admin",txtVal);
}
}// end func