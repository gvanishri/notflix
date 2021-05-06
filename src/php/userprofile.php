
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="tranCSS-srcFile.css">
<script src="validateFrm.js"></script>
<script src="prfElmnt-srcFile.js"></script>
<script src="prfEvent-srcFile.js"></script>

<style>
.imgCls {
width:30px;
height:30px;
}

.circle {
  height: 40px;
  width: 40px;
  //background-color: #555;
  //background-color:#FAEBD7;
  background-color:#e6f5ff;
  border-radius: 50%;
  padding:10px;
text-align:center;
//vertical-align:middle;
  font-size:30px;
}

/*
.clsDivCnt {
position:absolute;
display:none;
padding-left:10px;
padding-top:10px;
padding-bottom:10px;
min-width:120px;
background-color:#e6f5ff;
border: 1px solid green;
margin-top: 10px;
z-index: 1;
}

.clsDivCnt:after {
  content: "";
  position:absolute;
  //background:#ddd;
  background:#ddd;
  width:20px;
  height:20px;
  transform:rotate(-45deg);
  
  border: 1px solid green;
  z-index:-1;
  border-left: 0px solid transparent;
  border-bottom: 0px solid transparent;
  top:-11px;
  left:calc(20% - 10px);
}

.clsDivCnt button:hover {
background-color: #e6f5ff;
}
*/

td {
border: 0px solid black;
}

</style>
</head>

<body>

<div style="width:100%;">
<table id="tblProfile" style="margin:10px;">

</table>
</div>

<?php
session_start();

include 'connsrvr.php';
include 'globaldefault.php';

$phpUsrID = $_GET['txtUsr'];
$phpMnuInfo = $_GET['mnuVal'];

//echo "<br><br>" .$phpMnuInfo ."<br><br>";

$usrInitial = "";
$usrName = "";
$usrID = "";
$usrPwd = "";
$urlVal = siteURL();
$pageAttr = $loginPageAttr;
$hdrRowAttr = $loginPageHdr;

//echo $phpUsrID;

//echo "Welcome user Profile: " .$_SESSION['currUsrRS']['UserName'];
//echo "Welcome user Profile: " .$_SESSION['currUsrRS']['FirstName'];

function showUsrMenu() {

$rs = $_SESSION['currUsrRS'];
//echo "Welcome user Profile: " .$rs['UserName'];
//echo "Welcome user Profile: " .$rs['FirstName'];

//$tempArr = explode($GLOBALS['dlmtr1'], $GLOBALS['custCrdn']);
$tempArr = explode($GLOBALS['dlmtr1'], $GLOBALS['userCrdn']);
//echo $tempArr[1];

$colArr = explode($GLOBALS['dlmtr2'], $tempArr[1]);
//echo $colArr;
$i = 0;
foreach ($colArr as $colInfo) {
$valX = $colInfo;
$arr = explode($GLOBALS['dlmtr3'],$colInfo);

$valY = "";
if (strstr($arr[0],"date") == "date" || strstr($arr[0],"Date") == "Date" ) {
$valY = formatDate($rs[$arr[1]],"1");
} else {
$valY = $rs[$arr[1]];
}

 if($i == 0) {
  $GLOBALS['currUsr'] = $valX ."~" .$valY;
  } else {
  $GLOBALS['currUsr'] = $GLOBALS['currUsr'] ."|" .$valX ."~" .$valY;
  }

$i = $i + 1;
} // for each

$GLOBALS['currUsr'] = $tempArr[0] ."||" .$GLOBALS['currUsr'];

$GLOBALS['usrID'] = $rs['UserAcctID'];
$GLOBALS['usrPwd'] = $rs['UserPwd'];
$GLOBALS['usrName'] = $rs['UserName'];
$GLOBALS['usrInitial'] = strtoupper(substr($GLOBALS['usrName'], 0, 1));

//echo $GLOBALS['currUsr'];
} //end func

showUsrMenu();

?>

<script>

var currUsrRS = '<?php echo $GLOBALS['currUsr'] ?>';

var currUsrAddrRS = "";

strColor = sessionStorage.clrSelected;

function setUsrPrfColor(strColor) {

var clrVal = "";
var clrName = "";

themeClr = parent.getColorPalatte(strColor);

if (themeClr == null || themeClr == undefined) {
//skip
} else {
clrName = strColor + "_clrSelf";
clrVal = themeClr[clrName].bgColor;

var elem = document.getElementsByClassName("circle");
for(var i = 0; i < elem.length; i++) {
  //alert(elem[i].tagName.toLowerCase());
  if (elem[i].tagName.toLowerCase() == 'p') {
      elem[i].style.backgroundColor = clrVal;
  } //if
} // for
} // if themeClr null
} // end func

func_bindPrfFrmElmnt();

function funcAssignUserDefault() {
tempX = document.getElementById("prfLblUsr");
tempX.innerHTML = '<?php echo $GLOBALS['usrName'] ?>';

tempX = document.getElementById("prfLblUsrID");
tempX.innerHTML = '<?php echo $GLOBALS['usrID'] ?>';

tempX = document.getElementById("prfLblUsrPwd");
tempX.innerHTML = '<?php echo $GLOBALS['usrPwd'] ?>';

tempX = document.getElementById("prfPara");
tempX.innerHTML = '<?php echo $GLOBALS['usrInitial'] ?>';

funcBindValToElmnt('prfAcct');
//onUserMnuBtnClick('btnProfile','div1');

var mnuVal = '<?php echo $phpMnuInfo ?>';

//alert(mnuVal);
if (mnuVal == "login") {
mnuVal = "usracct";
}
onUserMnuBtnClick(mnuVal,'div1');

setUsrPrfColor(strColor);
}

funcAssignUserDefault();

</script>

</body>
</html>