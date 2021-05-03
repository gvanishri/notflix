
function createScriptElmntWithSrc(scriptType,scriptName,srcFN) {
var retVal;

//alert(" Message line : createScriptElmntWithSrc");

var headTag = document.getElementsByTagName("head")[0]
var jsDocElmnt = document.createElement("script");
jsDocElmnt.type = scriptType; //"text/javascript";
jsDocElmnt.name = scriptName;
jsDocElmnt.src = srcFN;
headTag.appendChild(jsDocElmnt);

} // end func

function loadScriptFilesDynOnLoad() {
var jsSrcFN;
var scriptName;
var scriptType;

//console.log(" Message line : loadScriptFilesDynOnLoad");

//alert(" Message line : loadScriptFilesDynOnLoad");


scriptName="urlLnk";
scriptType="text/javascript";
jsSrcFN = "context/urlLinkContext.txt";
createScriptElmntWithSrc(scriptType,scriptName,jsSrcFN);

/*
scriptName="cntContent";
scriptType="text/javascript";
jsSrcFN = "content-srcFiles/cnt-txtFile.txt";
func_createScriptElmntWithSrc(scriptType,scriptName,jsSrcFN);

scriptName="shpContent";
scriptType="text/javascript";
jsSrcFN = "content-srcFiles/shipping-txtFile.txt";
func_createScriptElmntWithSrc(scriptType,scriptName,jsSrcFN);

scriptName="rfdContent";
scriptType="text/javascript";
jsSrcFN = "content-srcFiles/refund-txtFile.txt";
func_createScriptElmntWithSrc(scriptType,scriptName,jsSrcFN);

scriptName="trmContent";
scriptType="text/javascript";
jsSrcFN = "content-srcFiles/terms-txtFile.txt";
func_createScriptElmntWithSrc(scriptType,scriptName,jsSrcFN);
*/
} // end func