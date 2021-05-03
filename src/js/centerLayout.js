
//bind imgRow  elements

var imgElmntDef = "";
var imgAttrDef = "";

imgElmntDef = "";
//imgTbl->imgRow->dynaCol01
imgElmntDef = "dynaRow|dynaCol01|td";

imgElmntDef = imgElmntDef + "||" + "dynaCol01|imgDiv|div";
imgElmntDef = imgElmntDef + "||" + "imgDiv|lnkPrev|a";
imgElmntDef = imgElmntDef + "||" + "imgDiv|imgDisp|img";
imgElmntDef = imgElmntDef + "||" + "imgDiv|lnkNext|a";

imgAttrDef = "";

imgAttrDef = "dynaCol01|style|width:100%;";

imgAttrDef = imgAttrDef + "||" + "imgDiv|style|position:relative;";

imgAttrDef = imgAttrDef + "||" + "lnkPrev|class|imgNavCls";
imgAttrDef = imgAttrDef + "||" + "lnkPrev|style|left:5%;";
imgAttrDef = imgAttrDef + "||" + "lnkPrev|innerHTML|&#8249;";
imgAttrDef = imgAttrDef + "||" + "lnkPrev|onclick|displayImg(lnkPrev)";

imgAttrDef = imgAttrDef + "||" + "lnkNext|class|imgNavCls";
imgAttrDef = imgAttrDef + "||" + "lnkNext|style|right:5%;";
imgAttrDef = imgAttrDef + "||" + "lnkNext|innerHTML|&#8250;";
imgAttrDef = imgAttrDef + "||" + "lnkNext|onclick|displayImg(lnkNext)";

//imgAttrDef = imgAttrDef + "||" + "imgDisp|src|images/img-srcFiles/img01.jpg";
imgAttrDef = imgAttrDef + "||" + "imgDisp|alt|imageDisplay";
imgAttrDef = imgAttrDef + "||" + "imgDisp|style|width:100%;height:1000px;display:block;text-align:center;";

var imgArr = {
 1: {imgID:"img01",imgCode:"1",imgSrc:"images/img01.jpg",imgCaption:"Image 1",currImg:"NA"},
 2: {imgID:"img02",imgCode:"2",imgSrc:"images/img07.jpg",imgCaption:"Image 2",currImg:"NA"},
 3: {imgID:"img03",imgCode:"3",imgSrc:"images/img08.jpg",imgCaption:"Image 3",currImg:"NA"},
};


function displayImg(elmntX) {
    var imgIndx = null;
    imgIndx = eval(getCurrentImgCode());
    if (elmntX.id == "lnkPrev") {
        if (imgIndx == 1) {
            imgIndx = Object.keys(imgArr).length;
        } else {
            imgIndx = imgIndx - 1;
        }
    } else if (elmntX.id == "lnkNext") {
        if (imgIndx == Object.keys(imgArr).length) {
            imgIndx = 1;
        } else {
            imgIndx = imgIndx + 1;
        }
    } else {
        //skip
    }
    showSlides(imgIndx);
}// end func


function showSlides(imgCode) {

tmpX = document.getElementById("lnkPrev");
tmpY = document.getElementById("lnkNext");

//alert(Object.keys(imgArr).length);
if (imgCode == "" || imgCode == null || imgCode == undefined) {
imgCode = "1";
} else if (imgCode > Object.keys(imgArr).length) {
    imgCode = "1";
    //alert("image : " + imgCode);
} else if (Object.keys(imgArr).length == 1) {
  //skip
  tmpX.style.display = "none";
  tmpY.style.display = "none";
} else {
  //skip
  tmpX.style.display = "block";
  tmpY.style.display = "block";
}

//alert("image : " + imgCode);
//alert("Current img : " + imgArr[imgCode].imgSrc);

var tempX = document.getElementById("imgDisp");
//alert("Current img : " + tempX);
tempX.setAttribute("src",imgArr[imgCode].imgSrc);

resetCurrentImgCol();

imgArr[imgCode].currImg = imgCode;
//alert("Current img : " + imgArr[imgCode].currImg);

}// end func

function resetCurrentImgCol() {

for (var tempImg in imgArr) {
imgArr[tempImg].currImg = "NA";
} // for loop

} // end func

function getCurrentImgCode() {

var currImgCode = null;

for (var tempImg in imgArr) {

if (imgArr[tempImg].currImg == "NA") {
//skip
} else {
currImgCode = imgArr[tempImg].currImg;
}// if currImg == NA

}//for each imgArr

return currImgCode;

}// end func


function bindCenterLayout() {

//alert("function - bindCenterLayout");

//alert("function - bindCenterLayout : " + imgElmntDef);

bindElmntDef(2,imgElmntDef);

//alert("function - bindCenterLayout : " + imgAttrDef );

bindElmntAttrRule(2,imgAttrDef);

showSlides(1);

//func_bindNavNodesToImg(Object.keys(imgArr).length);

}
