
<?php 
include 'connsrvr.php';

//$phpName = $_GET['name'];
$txtVal = $phpName;

$tsql = "";
$currDBMaxVal = "";
$auditDBMaxVal = "";
$trckIDMaxVal = "";

/*
echo $txtVal;
echo "<br>";
echo $auditDB;
echo "<br>";
echo $userCrdn;
echo "<br>";
*/

$trckDBArr = "";
$trckDBArr = explode($dlmtr2,$trckSrcDB);

/*
echo $trckDBArr[0];
echo "<br>";
echo $trckDBArr[1];
echo "<br>";
echo $trckDBArr[2];
echo "<br>";
echo $trckDBArr[3];
echo "<br>";
*/

$auditArr = "";
$auditArr = explode($dlmtr2,$auditDB);

/*
echo $auditArr[0]; //auditlog
echo "<br>";
echo $auditArr[1]; //LogID
echo "<br>";
echo $auditArr[2]; //AuditLogID
echo "<br>";
echo $auditArr[3]; //Prefix
echo "<br>";
*/


$tempArr = "";
switch ($txtVal) {
  case "user":
       $tempArr = explode($dlmtr1, $userCrdn);
       break;
  case "rvw":
       $tempArr = explode($dlmtr1, $rvwCrdn);
       break;
  case "track":
       $tempArr = explode($dlmtr1, $trackCrdn);
       break;
  case "audit":
       $tempArr = explode($dlmtr1, $auditCrdn);
       break;
  case "trackaudit":
       $tempArr = explode($dlmtr1, $trackAuditCrdn);
       break;
  default:
    echo "Select a valid DB table";
}

/*
echo $tempArr[0];
echo "<br>";
echo $tempArr[1];
echo "<br>";
*/

$dbArr = "";
$dbArr = explode($dlmtr2, $tempArr[0]);
$colArr = "";
$colArr = explode($dlmtr2, $tempArr[1]);

$tblCaption = "";
$tblCaption = $dbArr[0];
$dbName = "";
$dbName = $dbArr[1];
$autoGenKeyCol = "";
$autoGenKeyCol = $dbArr[2];
$keyCol = "";
$keyCol = $dbArr[3]; 
$keyPrefix = "";
$keyPrefix =  $dbArr[4];
$tblModify = "";
$tblModify =  $dbArr[5]; 

/*
echo $tblCaption;
echo "<br>";
echo $dbName;
echo "<br>";
echo $keyCol;
echo "<br>";
echo $tblModify;
echo "<br>";
*/

function funcFetchData($srvrConn,$txtVal)
{
$rowIndx = 0;
$colIndx = 0;
//echo $GLOBALS['dbName'];
//echo $GLOBALS['currDBMaxVal'];
$tsql = "Select * from " .$GLOBALS['dbName'];

//$stmt = sqlsrv_query($srvrConn, $tsql);

$result = fetchEntityResultSet($srvrConn,$tsql);
if (mysqli_num_rows($result) > 0) {
//echo $tsql;
//echo "<br>";
//echo $GLOBALS['colArr'][0];

$strName = "";
$strCaption = "";

echo "<button name='btnExport' id='btnExport' onclick='exportData()' style='float:right;margin-right:15%;'>Export to excel</button><br>";

echo "<table id='frmData'>";

echo "<caption id='capID'>" .$GLOBALS['tblCaption'] ."</caption>";

echo "<tr id='hdrID'>";

$x = 0;

foreach ($GLOBALS['colArr'] as $hdr) {
//$hdrVal = explode("~",$hdr);
$hdrVal = explode($GLOBALS['dlmtr3'],$hdr);

echo "<th id=" .$hdrVal[1] .">";
echo $hdrVal[0];
echo "</th>";
$x = $x + 1;
}

echo "</tr>";

while($row = mysqli_fetch_assoc($result)) 
{
$rowIndx = ($rowIndx + 1);
$rowName = $GLOBALS['dbName'] ."row" .$rowIndx;
//echo $rowName;
echo "<tr id=" .$rowName .">";

$tempArr = "";

foreach ($GLOBALS['colArr'] as $colInfo) 
{
//echo $colInfo;
//echo "<br><br>";

//echo $GLOBALS['dlmtr3'];
//echo "<br><br>";

//$tempArr = explode("~",$colInfo);
$tempArr = explode($GLOBALS['dlmtr3'],$colInfo);

//echo $tempArr[0] ."-" .$tempArr[1] ."-" .$tempArr[2] ."-" .$tempArr[3];
//echo "<br><br>";

$arr = $tempArr[1];
$arrEdit = $tempArr[2];
$arrDefault = $tempArr[3];

$colIndx = ($colIndx + 1);

$lenVal = (strlen($row[$arr]) + 2);

$colName = "";
//$colName = $GLOBALS['dbName'] ."col" .$colIndx;
$colName = $GLOBALS['dbName'] ."row" .$rowIndx ."col" .$colIndx;
//echo $colName;
echo "<td id=" .$colName .">";

$strName = "";
$strName = $GLOBALS['dbName'] .$arr .$rowIndx;

if ($arr == "RvwMsg" || $arr == "TrackDesc" || $arr == "TrackSrc" || $arr == "UpdateInfo") {
echo "<label id=" .$strName ." style='display:none;' value=" .$row[$arr] .">" .$row[$arr] ."</label>";
} else {

if($arr == "UserAdmin" || $arr == "UserPwd") {
if($arr == "UserPwd") {
$hash = base64_decode ($row[$arr]);
$valX = $hash;
} else {
$valX = $row[$arr];
}
$valX = preg_replace("|.|","*",$valX);
} else {
//$valX = $row[$arr];
//echo $arr ."<br><br>";
if (strstr($arr,"date") == "date" || strstr($arr,"Date") == "Date" ) {
$valX = formatDate($row[$arr],"1");
} else {
$valX = $row[$arr];
}
}
echo "<label id=" .$strName ." value=" .$row[$arr] .">" .$valX ."</label>";
}

$strName = "";
$strName = $GLOBALS['dbName'] .$arr .$rowIndx ."-edit"; 
echo "<label id=" .$strName ." style='display:none;' value=" .$arrEdit .">" .$arrEdit ."</label>";

$strName = "";
$strName = $GLOBALS['dbName'] .$arr .$rowIndx ."-default"; 
echo "<label id=" .$strName ." style='display:none;' value=" .$arrDefault .">" .$arrDefault ."</label>";

$strName = "";
$strName = $GLOBALS['dbName'] .$arr .$rowIndx ."-oldval";
//echo $strName;
echo "<label id=" .$strName ." style='display:none;' value=" .$row[$arr] .">" .$row[$arr] ."</label>";

if ($arr == "RvwMsg" || $arr == "TrackDesc" || $arr == "TrackSrc" || $arr == "UpdateInfo") {
$strName = "";
$strName = $GLOBALS['dbName'] ."btn" .$rowIndx;
if ($arr == "TrackSrc") {
$strCaption = "Click to view image";
$strName = "";
$strName = $GLOBALS['dbName'] .$arr .$rowIndx ."-tmp"; 
echo "<label id=" .$strName ." style='display:none;' value='NA'>NA</label>";
} else {
$strCaption = "Click to read text";
}
$cellInfo = $row[$arr];
echo "<button id=" .$strName ." onclick=funcBindElmntEvent('" .$GLOBALS['dbName'] ."','" .$arr ."','" .$rowIndx ."')>";
echo $strCaption;
echo "</button>";

} else {
//skip
}

echo "</td>";
} // for each

if ($GLOBALS['tblModify'] == "AppendnEditnDelete") 
{
$strName = "";
$strName = "lblEdit" .$rowIndx;
$btnName = "btnEdit" .$rowIndx;

echo "<td>";
echo "<label id=" .$strName ." style='display:none;' >no</label>";
echo "<button id=" .$btnName ." onclick=showPopupFrm('edit','" .$GLOBALS['dbName'] ."','" .$rowIndx ."')> EDIT </button>";
echo "</td>";
}
$strName = "";
$strName = "lblDelete" .$rowIndx;
$btnName = "btnDelete" .$rowIndx;

echo "<td>";
echo "<label id=" .$strName ." style='display:none;' >no</label>";
echo "<button id=" .$btnName ." onclick=showPopupFrm('delete','" .$GLOBALS['dbName'] ."','" .$rowIndx ."')> DELETE </button>";
echo "</td>";

echo "</tr>";
}// while rows 

echo "<tr id='maxID'>";
echo "<td><label id='dbKeyCol' >" .$GLOBALS['keyCol'] ."</label></td>";
echo "<td><label id='dbMaxVal' >" .$GLOBALS['currDBMaxVal'] ."</label></td>";
echo "<td><label id='auditMaxVal' >" .$GLOBALS['auditDBMaxVal'] ."</label></td>";
if ($GLOBALS['dbName'] == "videotrack") {
$trckDestSrc = $GLOBALS['trckSrcDir'];
echo "<td><label id='trckSrcName' >" .$GLOBALS['trckIDMaxVal'] ."</label></td>";
echo "<td><label id='trckFileSrc' >" .$GLOBALS['trckSrcDir'] ."</label></td>";
echo "<td><label id='trckDestSrc' >" .$trckDestSrc ."</label></td>";
}
echo "</tr>";

echo "</table>";

if ($GLOBALS['tblModify'] == "AppendnEditnDelete") 
{
echo "<center style='padding-top:20px;'> <button id=btnNew onclick=showPopupFrm('append','" .$GLOBALS['dbName'] ."','1')>" ."APPEND NEW RECORD" ."</button></center>";
} else {
//skip
}

} else {
//	echo "Query fetched 0 rows <br>";
} // if num of rows > 0


mysqli_free_result($result);
} // end func

$conn = connMySQL($servername,$username,$password,$schemaname);

//echo "<br><br>";
//$tsql1 = "Select COALESCE(MAX(" .$keyCol ."),'" .$keyPrefix ."00000') as " .$keyCol ." from " .$dbName;
//$tsql1 = "SELECT MAX(UserID) From UserAcct";
$tsql1 = "SELECT COALESCE(MAX(" .$autoGenKeyCol ."),0) as " .$autoGenKeyCol ." FROM " .$dbName;
//echo $tsql1;
$maxVal = fetchEntityMAXIDQuery($conn,$tsql1,$autoGenKeyCol);
//autogenkeycol and prefix concat
$currDBMaxVal = generateMAXID($keyPrefix,$maxVal,"NA","NA");
//echo "MAX - Code - " .$dbName .":" .$currDBMaxVal;

//echo "<br><br>";

//$tsql2 = "Select MAX(auditID) as auditID from auditlog";
//echo $auditArr[0] .$auditArr[1];
$tsql2 = "Select COALESCE(MAX(" .$auditArr[1] ."),0) as " .$auditArr[1] ." from " .$auditArr[0];
//echo $tsql2;
$maxVal = fetchEntityMAXIDQuery($conn,$tsql2,$auditArr[1]);
//autogenkeycol and prefix concat
$auditDBMaxVal = generateMAXID($auditArr[3],$maxVal,"NA","NA");
//echo "MAX - Code - AuditLog :" .$auditDBMaxVal;

//echo "<br><br>";
if ($dbName == "videotrack") {
//$tsql3 = "Select COALESCE(MAX(ImgID),'IMG-00000') as TrackSrcID from tracksrclog";
$tsql3 = "Select COALESCE(MAX(" .$trckDBArr[1] ."),0) as " .$trckDBArr[1] ." from " .$trckDBArr[0];
//echo $tsql3;
$maxVal = fetchEntityMAXIDQuery($conn,$tsql3,$trckDBArr[1]);
//autogenkeycol and prefix concat
$trckIDMaxVal = generateMAXID($trckDBArr[3],$maxVal,"NA","yes");
//echo "MAX - Code - trcksrclog :" .$trckIDMaxVal;
//echo "<br><br>";
}

funcFetchData($conn,$txtVal);

mysqli_close($conn);
?>

