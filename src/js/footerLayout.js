
//bind ftrRow  elements
var ftrElmntDef = "";

ftrElmntDef = "ftrRow|ftrCol01|td";

ftrElmntDef = ftrElmntDef + "||" + "ftrRow|ftrCol02|td";

ftrElmntDef = ftrElmntDef + "||" + "ftrCol01|ftrDisp01|label";
ftrElmntDef = ftrElmntDef + "||" + "ftrCol02|ftrDisp02|label";

//bind ftrRow elmnt attributes
ftrAttrDef = "ftrCol01|style|width:75%;padding:10px;";
ftrAttrDef = ftrAttrDef + "||" + "ftrCol02|style|width:25%;padding:10px;";

ftrAttrDef = ftrAttrDef + "||" + "ftrDisp01|innerHTML|&nbsp;";

ftrAttrDef = ftrAttrDef + "||" + "ftrDisp02|style|float:right;";
ftrAttrDef = ftrAttrDef + "||" + "ftrDisp02|innerHTML|@Copyright 2021, NotFLIX";

function bindFooterLayout() {

//alert("function - bindFooterLayout");

//alert("function - bindFooterLayout : " + ftrElmntDef);

bindElmntDef(2,ftrElmntDef);

//alert("function - bindFooterLayout : " + ftrAttrDef );

bindElmntAttrRule(2,ftrAttrDef);

ftrElmntDef="";
ftrAttrDef="";
}
