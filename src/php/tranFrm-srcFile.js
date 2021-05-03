
//var urlVal = location.protocol +"//"+  location.hostname + ":" + location.port +"/";
var urlVal = sessionStorage.siteDomainName;

window.onclick = function(event) {
var divX = document.getElementById("popupDiv");
  if (event.target == divX) {
     divX.style.display = "none";
  }
}

//alert(urlVal);
//alert(sessionStorage.clrSelected);

var strColor = sessionStorage.clrSelected;
var themeClr = parent.getColorPalatte(strColor);

var clrName = "";
var clrVal = "";

if (themeClr == null || themeClr == undefined) {
//skip
} else {
clrName = strColor + "_clrSelf";
clrVal = themeClr[clrName].bgColor;
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function funcReplaceStrVal(strVal,srchVal,newVal) {
//var newVal = strVal.replace(/\|/g," ");
//strVal.replace(/[^A-Za-z]/g,'');
//str.match(/ain/g);
//alert(strVal);
var valX = "";

if (strVal == null || strVal == undefined || strVal == "") {
//skip
} else {
var i=0;
var strLength = strVal.length;
for(i=0; i < strLength; i++) {
 if (newVal == "" || newVal == " "){
 strVal = strVal.replace(srchVal," ");
 } else {
 strVal = strVal.replace(srchVal,newVal);
 }
}
valX =strVal;
}
return valX;
}

/*
function getCounter() {
var rowCnt = 0;
if (sessionStorage.clickcount) {
rowCnt = sessionStorage.clickcount;
} else {
rowCnt = 0;
}
return rowCnt;
} // end func
*/

function resetCounter() {
if (sessionStorage.clickcount) {
      sessionStorage.clickcount = 0;
    } else {
      //skip
    }
}

function increaseCounter() {
    if (sessionStorage.clickcount) {
      sessionStorage.clickcount = Number(sessionStorage.clickcount)+1;
    } else {
      sessionStorage.clickcount = 0;
    }
}

function decreaseCounter() {
    if (sessionStorage.clickcount) {
      sessionStorage.clickcount = Number(sessionStorage.clickcount)-1;
    } else {
      sessionStorage.clickcount = 0;
    }
}

function funcBindElmntEvent(dbX,dbCol,selIndx) {

var strID = dbX+dbCol+selIndx;
//alert(document.getElementById(strID));

var tempX = "";
var blnVal = true;
tempX = document.getElementById(strID);

if (dbCol == "TrackSrc") {
var tmpID = dbX+dbCol+selIndx+"-tmp";
var tempY = document.getElementById(tmpID);
var valX = tempY.innerHTML;
if (valX == "NA") {
//
} else {
tempX = tempY;
blnVal = false;
}
} 
//alert(tempX.innerHTML);

var parentX = tempX.parentElement;
var txtVal = "";

if (tempX.tagName.toLowerCase() == "label") {
txtVal = tempX.innerHTML;
} else {
txtVal = tempX.value;
}

if (dbCol == "TrackSrc") {
funcShowVideoView(parentX,txtVal,blnVal);
} else {
funcReadMultiLineTxt(parentX,txtVal);
}

} // end func

function funcHideVideoView() {
var divX = document.getElementById("divVideoSrc");

if (divX == null || divX == undefined || divX == "") {
//skip
} else {
removeAllChildNodes(divX);
var tempX = divX.parentElement;
tempX.removeChild(divX);
}
} // end func

function funcShowVideoView(parentX,dataVal,blnAppdSiteURL) {

funcHideVideoView();

var divX = "";
divX = document.createElement("div");
divX.setAttribute("id","divVideoSrc");
divX.style = "position:absolute;padding:10px;margin: 0px;overflow:auto;border-radius:5px;border: 2px solid black;";
divX.style.minWidth = "210px";
divX.style.minHeight = "210px";
divX.style.backgroundColor = clrVal;


elmntX = document.createElement("video");
elmntX.setAttribute("id","trckView");
if (blnAppdSiteURL == true) {
srcX = urlVal + dataVal;
} else {
srcX = dataVal;
}
//alert(srcX);
elmntX.setAttribute("src",srcX);
elmntX.setAttribute("width","200px");
elmntX.setAttribute("height","200px");
divX.appendChild(elmntX);

elmntX = document.createElement("p");
divX.appendChild(elmntX);

elmntX = document.createElement("button");
elmntX.setAttribute("id","btnClose");
elmntX.setAttribute("style","padding:10px;outline:none;border:0px;border-radius:5px;background-color:#e6f5ff;");               
elmntX.setAttribute("onclick","funcHideVideoView()");
elmntX.innerHTML = "Close";
divX.appendChild(elmntX);

parentX.appendChild(divX);
}

function funcHideMultiLineTxt() {
var divX = document.getElementById("divMultiLn");

if (divX == null || divX == undefined || divX == "") {
//skip
} else {
removeAllChildNodes(divX);
var tempX = divX.parentElement;
tempX.removeChild(divX);
}
} // end func

function funcReadMultiLineTxt(parentX,dataVal) {

funcHideMultiLineTxt();

var divX = "";
divX = document.createElement("div");
divX.setAttribute("id","divMultiLn");
divX.style = "position:absolute;padding:10px;margin: 0px;overflow:auto;border-radius:5px;border: 2px solid black;";
divX.style.minWidth = "200px";
divX.style.backgroundColor = clrVal;

elmntX = document.createElement("p");
elmntX.setAttribute("id","multiLnTxt");
elmntX.setAttribute("style","text-align:left;padding:10px;border:0px solid #FAEBD7;border-radius:5px;background-color:#e6f5ff");
var valX = "";
valX = funcReplaceStrVal(dataVal,"\n","<br>");
//valX = valX.replace(/\n/g, '<br/>');
elmntX.innerHTML = valX; //"Multiline text display" + selNodeIndx;
divX.appendChild(elmntX);

elmntX = document.createElement("button");
elmntX.setAttribute("id","btnClose");
elmntX.setAttribute("style","padding:10px;outline:none;border:0px;border-radius:5px;background-color:#e6f5ff;");               
elmntX.setAttribute("onclick","funcHideMultiLineTxt()");
elmntX.innerHTML = "Close";
divX.appendChild(elmntX);

parentX.appendChild(divX);
} // end func
