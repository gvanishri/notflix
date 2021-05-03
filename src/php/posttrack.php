
<html>

<?php
include 'connsrvr.php';

$txtTranID = "";
$txtTranCurrTime = "";

//$trckIDVal = $_POST['trckID'];
//$usrIDVal = $_POST['usrID'];

$trckName = $_POST['trckTitle'];
$trckSrc = $_POST['trckSrc'];
$trckID = $_POST['trckID'];

$usrID = $_POST['usrID'];
$usrName = $_POST['usrName'];

/*
echo "testing1";
echo "<br><br>";
echo $trckID;
echo "<br><br>";
echo $usrID;
echo "<br><br>";
echo $usrName;
*/

$tranTrckInfo = $_POST['tranTrckInfo'];
/*
echo "<br><br>";
echo $tranTrckInfo;
*/

$usrAction = "";
$currTime = "";

function updateUserTranData($srvrConn,$trckInfo) {

//echo "<br><br>";
//echo $trckInfo;

$GLOBALS['usrAction'] = "";
$GLOBALS['currTime'] = "";

$tranArr = explode($GLOBALS['dlmtr1'],$trckInfo);

$cnt = count($tranArr);
//echo "arry count " .$cnt ."<br><br>";

for ($i=0;$i<$cnt;$i++) {
$tmpArr = explode($GLOBALS['dlmtr2'],$tranArr[$i]);

$usrArr = explode($GLOBALS['dlmtr3'],$tmpArr[0]);
$GLOBALS['usrAction'] = $usrArr[1];

$trckArr = explode($GLOBALS['dlmtr3'],$tmpArr[1]);
$GLOBALS['currTime'] = $trckArr[1];

/*
echo "<br><br>";
echo $usrAction;
echo "<br><br>";
echo $currTime;
*/

funcBindAcctInsertStmt($srvrConn);

} // for loop
}

//echo "testing";
function funcBindAcctInsertStmt($srvrConn) {

$t = microtime(true);
$micro = sprintf("%06d",($t - floor($t)) * 1000000);
$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );

//echo "testing2";
//print $d->format("Y-m-d H:i:s.u");

//$tranLogDateTime = "2021-04-21::02:34:33.00001";
$tranLogDateTime = $d->format("Y-m-d::H:i:s.u");
$GLOBALS['tranID'] = $tranLogDateTime;

//echo $tranLogDateTime;
//echo "<br><br>";
$stmtSQL = "";

$stmtSQL = "INSERT INTO audittran ";
$stmtSQL = $stmtSQL ."(TranID,UserAcctID,UserName,TrackID,UserAction,InteractionPoint,InteractionType) VALUES "; 
$stmtSQL = $stmtSQL ."('" .$tranLogDateTime ."','" .$GLOBALS['usrID'] ."','" .$GLOBALS['usrName'] ."','" .$GLOBALS['trckID'] ."','" .$GLOBALS['usrAction'] ."','" .$GLOBALS['currTime'] ."','" .$GLOBALS['usrAction'] ."')";

//echo $stmtSQL;
//echo "<br><br>";

funcEntityInsertQuery($srvrConn,$stmtSQL);

} // end func

$tmpArr = explode($dlmtr2, $trackSrchCrdn);

/*
echo $trackSrchCrdn;
echo "<br><br>";
*/

$tmpdbName = "";
$tmpdbName = $tmpArr[0];
$srchCol1 = "";
$srchCol1 = $tmpArr[1]; 
$srchCol2 = "";
$srchCol2 = $tmpArr[2]; 
$srchCol3 = "";
$srchCol3 = $tmpArr[3]; 

/*
echo $tmpdbName;
echo "<br><br>";
echo $srchCol1;
echo "<br><br>";
echo $srchCol2;
echo "<br><br>";
echo $srchCol3;
echo "<br><br>";
*/


function fetchTrackTranData($srvrConn,$srchUsrID,$srchTrckID) {
//$valX = "";
//$currIndx = 0;
//$txtTranArr = [];

$trantrckArr = explode($GLOBALS['dlmtr1'],$GLOBALS['tranTrackCrdn']);

$dbX = $trantrckArr[0];
$dbColArr = explode($GLOBALS['dlmtr2'],$trantrckArr[1]);

$tsql = "SELECT TranID, TrackID, InteractionPoint As TrackCurrTime FROM " .$GLOBALS['tmpdbName'] ." WHERE " .$GLOBALS['srchCol1'] ;
$tsql = $tsql ." IN (SELECT max(TranID) FROM ".$GLOBALS['tmpdbName'] ." where " .$GLOBALS['srchCol2'] ." = '" .$srchUsrID ."' AND " .$GLOBALS['srchCol3'] ." = '" .$srchTrckID ."' GROUP BY UserAcctID, TrackID)";
//echo $tsql ."<br><br>";

$resultSet = fetchEntityResultSet($srvrConn,$tsql);

//printf("Server version: %s\n", mysqli_get_server_info($conn));

if (mysqli_num_rows($resultSet) > 0) {
	//echo "Query fetched ". mysqli_num_rows($resultSet) ." rows <br>";

while($row = mysqli_fetch_assoc($resultSet)) {

//$txtTranArr[$currIndx] = "tranID~" .$row['TranID'] ."|" ."tranTrckID~" .$row['TrackID'] ."|" ."txtTrckCurrTime~" .$row['TrackCurrTime'];

//echo $txtTranArr[$currIndx] ."<br<br>";

//$currIndx = $currIndx + 1;

$cnt = count($dbColArr);

//TranID,TranTrackID,TranCurrTime
$tsql = "";
$tsql = "INSERT INTO" ." " .$dbX ." (";

for($i=0;$i<$cnt;$i++) {
	if ($i<($cnt-1)) {
		$tsql = $tsql .$dbColArr[$i] .",";
	} else {
		$tsql = $tsql .$dbColArr[$i] .")";
	}	 
}

$tsql = $tsql ." VALUES (";
$tsql = $tsql ."'" .$GLOBALS['usrID'] ."','" .$row['TranID']	."','" .$row['TrackID'] ."','" .$row['TrackCurrTime'] ."')";

$stmtSQL = $tsql;

//echo $stmtSQL;
//echo "<br><br>";

funcEntityInsertQuery($srvrConn,$stmtSQL);

} //end while

/*
//serialize the array and store in a file
$serialized = serialize($txtTranArr);

//Save the serialized array to a text file.
file_put_contents($GLOBALS['tranlogfile'], $serialized);
*/

//echo = $valX;
} else {
//echo "<br> Query fetched 0 rows <br>";
}
mysqli_free_result($resultSet);
} // end func

$conn = connMySQL($servername,$username,$password,$schemaname);

//funcBindAcctInsertStmt($conn);
updateUserTranData($conn,$tranTrckInfo);

fetchTrackTranData($conn,$usrID,$trckID);

mysqli_close($conn);

$trckTitle = preg_replace("| |","_",$trckName);

$cntxtVal = "";
$cntxtVal = "trckid~" .$trckID ."|" ."trcktitle~" .$trckTitle ."|" ."trcksrc~" .$trckSrc ."||";
$cntxtVal = $cntxtVal ."txtUsrID~" .$usrID ."|" ."txtUsrName~" .$usrName;

//echo $cntxtVal ."<br><br>";

?>

<script>

 if (sessionStorage.clickcount) {
      sessionStorage.clickcount = 0;
    } else {
      sessionStorage.clickcount = 0;
    }

//alert(sessionStorage.clickcount);
//document.write(sessionStorage.clickcount + "<br><br>");

//var urlPath = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
var urlPath = sessionStorage.siteDomainName;
//document.write(urlPath + "<br><br>");
var urlFile = "src/php/playtrack.php?cntxtVal=" + '<?php echo $cntxtVal ?>';
//document.write(urlFile + "<br><br>");
//var hrefVal = urlPath + "/" + urlFile;

var hrefVal = urlPath + urlFile;
//document.write(hrefVal + "<br><br>");
//alert(hrefVal);
window.location.href = hrefVal;

</script>
</html>
