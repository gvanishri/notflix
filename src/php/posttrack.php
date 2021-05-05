
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

</body>
<?php
include 'connsrvr.php';

$mnuVal = "";
$cntxtVal = "";

$txtTranID = "";
$txtTranCurrTime = "";

$trckName = "";
$trckSrc =  "";
$trckID = "";
$usrID = "";
$usrName = "";

$usrAction = "";
$currTime = "";

$tmpArr = "";
$tmpdbName = "";
$srchCol1 = "";
$srchCol2 = "";
$srchCol3 = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {	
	$usrID = $_GET['usrID'];
	$usrName = $_GET['usrName'];
	//echo "Request method - GET";
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
}

function updateUserFavourite($srvrConn) {
	$trckIDVal = $_GET['trckID'];
	$usrIDVal = $_GET['usrID'];
	$lnkAction = $_GET['lnkaction'];
	$dateVal = getCurrDateString();

	//echo "track - " .$trckIDVal ."<br><br>";
	//echo "User - " .$usrIDVal ."<br><br>";
	//echo "lnkaction - " .$lnkAction ."<br><br>";
	$dbX = "favourites";

	$logID = "";
	$dbVal = $dbX  ."|" .$lnkAction ."|yes";
	$keyVal = "keyVal|FavID|auto";
	$rsnVal = $lnkAction ."~" .$dbX ."|trackID~" .$trckIDVal ."|useracctid~" .$usrIDVal;	
	//echo $rsnVal ."<br><br>";

	$auditArr = "";
	$auditArr = explode($GLOBALS['dlmtr2'],$GLOBALS['auditDB']);

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

	//$tsql2 = "Select MAX(auditID) as auditID from auditlog";
	//echo $auditArr[0] .$auditArr[1];
	$tsql2 = "Select COALESCE(MAX(" .$auditArr[1] ."),0) as " .$auditArr[1] ." from " .$auditArr[0];
	//echo $tsql2;
	$maxVal = fetchEntityMAXIDQuery($srvrConn,$tsql2,$auditArr[1]);
	//autogenkeycol and prefix concat
	$auditDBMaxVal = generateMAXID($auditArr[3],$maxVal,"yes","NA");
	//echo "MAX - Code - AuditLog :" .$auditDBMaxVal;
	$logID = $auditDBMaxVal;

	$stmt1 = "";
	$stmt1 = "INSERT INTO auditlog (AuditLogID,DBInfo,KeyColInfo,LogMessage,LogDate) VALUES ";
	$stmt1 = $stmt1 ."('" .$logID ."','" .$dbVal ."','" .$keyVal ."','" .$rsnVal ."','" .$dateVal ."')";

	//echo $stmt1;
	//echo "<br><br>";	

	$stmt2 = "";
	if ($lnkAction == "Delete") {		
		$stmt2 = "";
		$stmt2 = "DELETE FROM " .$dbX ." WHERE ";
		$stmt2 = $stmt2 ."UserAcctID = '" .$usrIDVal ."'" ." AND " ."TrackID = '" .$trckIDVal ."'";
	
		//echo $stmt2;
		//echo "<br><br>";		
	} else if ($lnkAction == "Append") {
		$stmt2 = "";
		$stmt2 = "INSERT INTO " .$dbX ." (UserAcctID,TrackID,UpdateDate) VALUES ";
		$stmt2 = $stmt2 ."('" .$usrIDVal ."','" .$trckIDVal ."','" .$dateVal ."')";

		//echo $stmt2;
		//echo "<br><br>";
	}
	try {
		funcEntityInsertQuery($srvrConn,$stmt1);
		funcEntityInsertQuery($srvrConn,$stmt2);
	} catch (RuntimeException $e) {
		echo $e->getMessage();
		exit();
	}
} // end func

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

function fetchTrackTranData($srvrConn,$srchUsrID,$srchTrckID) {
	$trantrckArr = "";
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
			} // for loop

			$tsql = $tsql ." VALUES (";
			$tsql = $tsql ."'" .$GLOBALS['usrID'] ."','" .$row['TranID']	."','" .$row['TrackID'] ."','" .$row['TrackCurrTime'] ."')";

			$stmtSQL = $tsql;

			//echo $stmtSQL;
			//echo "<br><br>";

			funcEntityInsertQuery($srvrConn,$stmtSQL);

		} //end while

	} else {
		//echo "<br> Query fetched 0 rows <br>";
	}
	mysqli_free_result($resultSet);
} // end func

$mnuVal = "";
$cntxtVal = "";

$conn = connMySQL($servername,$username,$password,$schemaname);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$mnuVal = "fetchTrack";
	updateUserFavourite($conn);

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mnuVal = "playTrack";
	updateUserTranData($conn,$tranTrckInfo);

	fetchTrackTranData($conn,$usrID,$trckID);

	$trckTitle = preg_replace("| |","_",$trckName);

	$cntxtVal = "";
	$cntxtVal = "trckid~" .$trckID ."|" ."trcktitle~" .$trckTitle ."|" ."trcksrc~" .$trckSrc ."||";
	$cntxtVal = $cntxtVal ."txtUsrID~" .$usrID ."|" ."txtUsrName~" .$usrName;

	//echo $cntxtVal ."<br><br>";
}

mysqli_close($conn);

//echo $mnuVal;
//echo "<br><br>";
?>

<script>

var mnuVal = '<?php echo $mnuVal; ?>';
//alert(mnuVal);
var urlFile = "";
var urlPath = sessionStorage.siteDomainName;
//document.write(urlPath + "<br><br>");

if (mnuVal == "fetchTrack") {	
	var usrID = '<?php echo $usrID; ?>';
	var usrName = '<?php echo $usrName; ?>';

	var usrData = usrID + "|" + usrName;
	urlFile = "src/php/tracklist.php?usrInfo=" + usrData;

} else if (mnuVal == "playTrack") {
	/*
 	if (sessionStorage.clickcount) {
      sessionStorage.clickcount = 0;
    } else {
      sessionStorage.clickcount = 0;
    }
	//alert(sessionStorage.clickcount);
	//document.write(sessionStorage.clickcount + "<br><br>");
	*/

	urlFile = "src/php/playtrack.php?cntxtVal=" + '<?php echo $cntxtVal ?>';
}

//document.write(urlFile + "<br><br>");
var hrefVal = urlPath + urlFile;
//document.write(hrefVal + "<br><br>");
//alert(hrefVal);
window.location.href = hrefVal;

</script>
</body>
</html>
