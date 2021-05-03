var admFrmElmntDef = "";
var admFrmAttrDef = "";

//cntxtFrm-table

admFrmElmntDef = "dynaCol01|admDiv|div";
admFrmElmntDef = admFrmElmntDef + "||" + "admDiv|frmAdminFrame|iframe";

admFrmAttrDef = "";
//bind cntRow elmnt attributes
//admFrmAttrDef = "dynaCol01|style|width:100%;";

admFrmAttrDef = "admDiv|style|width:100%;";

function funcShowAdminFrame(mnuVal,txtVal) {
//alert("Table = " + txtVal);
var arr = "";

if (mnuVal == "admin") {
arr = frameAdmin.split("|");
} else if (mnuVal == "login" || mnuVal == "usracct" || mnuVal == "usrchgpwd") {
arr = frameLogin.split("|");
} else if (mnuVal == "track") {
arr = frameTrackList.split("|");
}

var paramVal = [""];
if (mnuVal == "admin") {
paramVal[0] = txtVal;
} else if (mnuVal == "login" || mnuVal == "usracct" || mnuVal == "usrchgpwd") {
paramVal[0] = txtVal;
paramVal[1] = mnuVal;
} else if (mnuVal == "track") {
paramVal[0] = txtVal;
}

var frmName = arr[0];
var frmUrl = arr[1]; 
var paramArr = arr[2];

frmUrl = frmUrl + funcBindURLParam(paramArr,paramVal);

//alert(frmUrl);

var frameX = document.getElementById(frmName);
//frameX.setAttribute("width",(screen.width - 80) + "px");
frameX.setAttribute("width","100%");
frameX.setAttribute("height","500px");
frameX.setAttribute("style","border:1px solid #FAEBD7;");
//frameX.setAttribute("src","http://localhost:8088/php-srcFiles/phpDataCntxt.php?name="+txtVal);
//frameX.setAttribute("src","php-srcFiles/phpDataCntxt.php?name="+txtVal);
frameX.setAttribute("src",frmUrl);
}//end func

function bindAdminLayout() {

//alert("function - bindAdminLayout");

//alert("function - bindAdminLayoutt : " + admFrmElmntDef);

bindElmntDef(2,admFrmElmntDef);

//alert("function - func_bindAdminFrmElmnt : " + admFrmAttrDef );

//bindElmntAttrRule(2,admFrmAttrDef);

}
