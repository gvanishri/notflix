<?php 
include 'connsrvr.php';

$phpUsrInfo = $_GET['usrData'];

$tmpVal = explode($dlmtr2,$phpUsrInfo);
$txtUsrID = $tmpVal[0];
$txtUsrName = $tmpVal[1];

$cntxtVal = "";

//echo "testing";

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


function fetchTrackTranData($srvrConn,$srchUsrID) {

$valX = "";
$currIndx = 0;
$txtTranArr = [];

$trantrckArr = explode($GLOBALS['dlmtr1'],$GLOBALS['tranTrackCrdn']);

$dbX = $trantrckArr[0];
$dbColArr = explode($GLOBALS['dlmtr2'],$trantrckArr[1]);

$tsql = "SELECT TranID, TrackID ,InteractionPoint As TrackCurrTime FROM " .$GLOBALS['tmpdbName'] ." WHERE " .$GLOBALS['srchCol1'] ;
$tsql = $tsql ." IN (SELECT max(TranID) FROM ".$GLOBALS['tmpdbName'] ." where " .$GLOBALS['srchCol2'] ." = '" .$srchUsrID ."' GROUP BY UserAcctID, TrackID)";
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
$tsql = $tsql ."'" .$GLOBALS['txtUsrID'] ."','" .$row['TranID']	."','" .$row['TrackID'] ."','" .$row['TrackCurrTime'] ."')";

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

} else {
//echo "Query fetched 0 rows <br>";
}

mysqli_free_result($resultSet);
} // end func

//$currTranID = "";
$tempArr = explode($dlmtr1, $trackCrdn);

/*
echo $tempArr[0];
echo "<br>";
echo $tempArr[1];
echo "<br>";
*/

$dbArr = explode($dlmtr2, $tempArr[0]);

$tblCaption = "";
$tblCaption = $dbArr[0];
$dbName = "";
$dbName = $dbArr[1];
$keyCol = "";
$keyCol = $dbArr[2]; 
$tblModify = "";
$tblModify =  $dbArr[3];

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

$colArr = $tempArr[1];

function funcFetchTrackData($srvrConn) {
$rowIndx = 0;
$colIndx = 0;
$nval = 0;

//$tsql = "Select * from " .$GLOBALS['dbName'];
$tsql = "Select * from " .$GLOBALS['dbName'];
//echo "<br><br>" .$tsql ."<br><br>";

$result = fetchEntityResultSet($srvrConn,$tsql);

echo "<table id='frmTrackList'>";

echo "<caption id='TrckCapID'>" .$GLOBALS['tblCaption'] ."</caption>";

if (mysqli_num_rows($result) > 0) {
	//echo "Query fetched ". mysqli_num_rows($result) ." rows <br>";

while($row = mysqli_fetch_assoc($result)) {
$nval = $nval+1;

//echo "<br><br>" .$nval ." - " .fmod($nval,3) ."<br><br>";

if ($nval == 1 || fmod($nval,4) == 0) {
$rowIndx = ($rowIndx + 1);
$rowName = $GLOBALS['dbName'] ."row" .$rowIndx;
//echo $rowName;
//style='float:left;vertical-align:top;margin-left:5%;text-align:center;'
echo "<tr id=" .$rowName ." style='vertical-align:top;margin-left:5%;text-align:center;'>";
} else if ($nval == 2) {
//skip
}

$colIndx = ($colIndx + 1);

$colName = "";
$colName = $GLOBALS['dbName'] ."col" .$colIndx;
//echo $colName;
echo "<td id=" .$colName .">";

$colName = "";
$colName = $GLOBALS['dbName'] ."TrackSrc" .$colIndx;
$cellInfo = $row['TrackSrc'];
$trckSrc = siteURL() .$cellInfo;

//echo $trckSrc;

$nameVal = phpHandleSpace($row['TrackTitle']);
//echo $nameVal;
$nameVal = addslashes($nameVal);
//echo $nameVal;

//echo "<br><br>" .$trckSrc ."<br><br>";

//echo "<video id=" .$colName ." src=" .$trckSrc ." width='200px' height='200px' onclick=funcZoomImgOnclick('" .$trckSrc ."','" .$nameVal ."') muted></video>";
echo "<video id=" .$colName ." src=" .$trckSrc ." width='200px' height='200px' muted></video>";

echo "<p> </p>";

$colName = "";
$colName = $GLOBALS['dbName'] ."TrackTitle" .$colIndx;

$nameVal = $row['TrackTitle'];
echo "<label id=" .$colName .">" .$nameVal ."</label>";

echo "<p> </p>";

$colName = "";
$colName = $GLOBALS['dbName'] ."TrackDesc" .$colIndx;

$nameVal = $row['TrackDesc'];
echo "<label id=" .$colName .">" .$nameVal ."</label>";

echo "<p> </p>";

$colName = "";
$colName = "lnkPlay" .$colIndx;

$trckID = $row['TrackID'];
$GLOBALS['txtTrackID'] = $trckID;
$valX = preg_replace("| |","_",$row['TrackTitle']);
$trckname = $valX;

//echo "<a id=" .$colName ." href=playtrack.php?trckid=" .$trckID ."&trcktitle=" .$trckname ."&trcksrc=" .$row['TrackSrc'] .">Click here to play video</a>";

//$cntxtVal = "trckid=" .$trckID ."&trcktitle=" .$trckname ."&trcksrc=" .$row['TrackSrc'] ."&txtUsrID=" .$txtUsrID ."&txtUsrName=" .$txtUsrName";

$GLOBALS['cntxtVal'] = "trckid~" .$trckID ."|trcktitle~" .$trckname ."|trcksrc~" .$row['TrackSrc'] ."||";
$GLOBALS['cntxtVal'] = $GLOBALS['cntxtVal'] ."txtUsrID~" .$GLOBALS['txtUsrID'] ."|txtUsrName~" .$GLOBALS['txtUsrName'];

//echo $GLOBALS['cntxtVal'] ."<br><br>";

//echo "<a id=" .$colName ." href=playtrack.php?cntxtVal=" .$GLOBALS['cntxtVal'] ."&test=Hello" .">Click here to play video</a>";
echo "<a id=" .$colName ." href=playtrack.php?cntxtVal=" .$GLOBALS['cntxtVal'] .">Click here to play video</a>";

} //while row

} else {
//echo "Query fetched 0 rows <br>";
$GLOBALS['cntxtVal'] = "NA";
} // if num of rows > 0
mysqli_free_result($result);

echo "</table>";

} // end func

$conn = connMySQL($servername,$username,$password,$schemaname);

fetchTrackTranData($conn,$txtUsrID);

funcFetchTrackData($conn);

mysqli_close($conn);

//echo $GLOBALS['cntxtVal'] ."<br><br>";
?>