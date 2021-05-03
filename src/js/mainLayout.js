
//Global Attribute rule definition

var tblAttrRule =  "hdrRow|style|width:100%;height:20px;background:#FAEBD7;";

tblAttrRule = tblAttrRule + "||" + "mnuRow|style|width:100%;height:40px;";//background-color:#FFFAF0;"; //border-bottom:3px solid #FAEBD7;";

tblAttrRule = tblAttrRule + "||" + "dynaRow|style|width:100%;";//background-color:#FFFAF0;";

//tblAttrRule = tblAttrRule + "||" + "rvwRow|style|font-size:12px;color:black;width:100%;height:200px;background-color:#FAFAD2;";

tblAttrRule = tblAttrRule + "||" + "ftrRow|style|width:100%;height:40px;";//background-color:#FAEBD7;";

function buildLayoutAttrDefString() {

//alert(" Message line : buildLayoutAttrDefString");

var attrDef = "";
attrDef = tblAttrRule;

//alert(" Message line : buildLayoutAttrDefStringt :" + attrDef);
try {
bindElmntAttrRule(2,attrDef);
} catch (err) {
alert("error : " + attrDef);
alert("error : " + err.description);
}
}

function bindElmntAttrRule(arrCnt,attrDefStr) {

//alert(" Message line : bindElmntAttrRule");

var arrIndx = 0;
var objArr = "";

if (objArr == null || objArr == undefined) {
arrIndx = 0;
} else {
arrIndx = (objArr.length-1);
} 

if (arrCnt == 1) {

//alert(" Message line : bindElmntAttrRule - arrCnt - 1");

arrIndx = arrIndx + 1;
bindElmntAttrRuleByID(attrDefStr);

} else if (arrCnt > 1) {

//alert(" Message line : bindElmntAttrRuleByID - arrCnt : " + arrCnt);

objArr = attrDefStr.split("||");

for (var i=0; i < objArr.length; i++) {

arrIndx = arrIndx + 1;
bindElmntAttrRuleByID(objArr[i]);

}//for i 

}else {

alert("invalid string");

}//if arrCnt == 1 or greater than 1 else invalid

}// end func


function bindElmntAttrRuleByID(attrRuleVal) {

//alert(" Message line : bindElmntAttrRuleByID");


var strVal = attrRuleVal.split("|");
var tagID = strVal[0];
var tagAttr = strVal[1];
var tagVal = strVal[2];

//alert(" Message line : bindElmntAttrRuleByID : " + tagID + " - " + tagAttr + " - " + tagVal);

try {

var elmnt = document.getElementById(tagID);
if (tagID == "ftrRow") {
//alert(elmnt.id);
}

if (tagAttr == "innerHTML") {

elmnt.innerHTML = tagVal;

} else {

elmnt.setAttribute(tagAttr, tagVal);
//alert(" Message line : bindElmntAttrRuleByID : " + elmnt.id);

} // if tagAttr 
} catch (err) {
alert("error : " + elmnt);
alert("error : " + tagAttr + "" + tagVal);
alert("error : " + err.description);
}

} // end func - bindElmntAttrRuleByID
