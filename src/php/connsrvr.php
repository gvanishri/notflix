<?php
/*
$WrkDir = "notflix";

$servername = "localhost";
$username = "root";
$password = "root";
$schemaname = "notflix";
*/

$config = parse_ini_file('config.ini');

$WrkDir = $config["rootpath"];

$servername = $config["servername"];
$username = $config["username"];
$password = $config["password"];
$schemaname = $config["schemaname"];

//define ("SECRETKEY", "notflix20210416");

$conn = "";
//$srvrDate = funcGetDateString();
$srvrDate = getCurrDateString();

$expiryDate = addDateToDateString($srvrDate,'1 year');

//string separator - delimeter
$dlmtr1 = "||";
$dlmtr2 = "|";
$dlmtr3 = "~";

$trckSrcDir = "src/php/videosrc/";

$tranlogfile = "tracktran.txt";

//$defaultPwd = "1234";

$validMnuNav = "yes";

//Customer table credentials
$trckSrcDB = "tracksrclog|SrcID|TrackSrcID|SRC";

$auditDB = "auditlog|LogID|AuditLogID|LOG";

$loginCrdn = "useracct|UserName|UserPwd|UserAdmin";

//$userCrdn = "Member|useracct|UserID|UserAcctID|USR|AppendnEditnDelete||AccountID~UserAcctID~readonly~NA|FirstName~UserName~disable~NA|LastName~LastName~enable~NA|Password~UserPwd~readonly~" .$defaultPwd ."|Email~UserEmail~enable~NA|Phone~UserPhone~enable~NA|RegiteredDate~RegisterDate~readonly~" .$srvrDate ."|ExpiryDate~ExpiryDate~readonly~" .$expiryDate ."|Roles~UserAdmin~readonly~user";

$userCrdn = "Member|useracct|UserID|UserAcctID|USR|AppendnEditnDelete||AccountID~UserAcctID~readonly~NA|FirstName~UserName~disable~NA|LastName~LastName~enable~NA|Password~UserPwd~readonly~NA|Email~UserEmail~enable~NA|Phone~UserPhone~enable~NA|RegiteredDate~RegisterDate~readonly~" .$srvrDate ."|ExpiryDate~ExpiryDate~readonly~" .$expiryDate ."|Roles~UserAdmin~readonly~user";

$UserFavCrdn = "favourites|FavID|UserAcctID|TrackID|UpdateDate~" .$srvrDate;

//Review table credentials
$rvwCrdn = "Review|UserRvw|RvwID|RVW|Delete||ReviewID~RvwID~readonly~NA|Name~RvwName~readonly~NA|Email~RvwEmail~readonly~NA|Phone~RvwPhone~readonly~NA|Message~RvwMsg~readonly~NA";

//videotrack table credentials
//$trackCrdn = "Track|videotrack|TrackID|TRCK|AppendnEditnDelete||Code~TrackID~readonly~NA|Name~TrackTitle~enable~NA|Description~TrackDesc~enable~NA|Src~TrackSrc~enable~NA|Date~TrackUploadDate~readonly~" .$srvrDate;
$trackCrdn = "Track|videotrack|VideoID|TrackID|TRCK|AppendnEditnDelete||Code~TrackID~readonly~NA|Name~TrackTitle~enable~NA|Description~TrackDesc~enable~NA|Src~TrackSrc~enable~NA|Date~TrackUploadDate~readonly~" .$srvrDate;

//Audit table credentials
//$auditCrdn = "AuditLog|AuditLog|AuditLogID|LOG|Delete||Code~AuditLogID~readonly~NA|DBInfo~DBInfo~readonly~NA|KeyColInfo~KeyColInfo~readonly~NA|LogMessage~LogMessage~readonly~NA|Date~LogDate~readonly~currdate";
$auditCrdn = "AuditLog|auditlog|LogID|AuditLogID|LOG|Delete||Code~AuditLogID~readonly~NA|DBInfo~DBInfo~readonly~NA|KeyColInfo~KeyColInfo~readonly~NA|LogMessage~LogMessage~readonly~NA|Date~LogDate~readonly~currdate";

//TrackAudit table credentials
$trackAuditCrdn = "TrackLog|audittran|TranID|TranID|TRAN|Delete||TranID~TranID~readonly~NA|UserAcctID~UserAcctID~readonly~NA|UserName~UserName~readonly~NA|TitleID~TrackID~readonly~NA|UserAction~UserAction~readonly~NA|InteractionPoint-[hh:mm:ss]~InteractionPoint~readonly~NA|InteractionType~InteractionType~readonly~NA";

$trackSrchCrdn = "audittran|TranID|UserAcctID|TrackID";

$tranTrackCrdn = "trantrack||UserAcctID|TranID|TranTrackID|TranCurrTime";

function siteURL()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    if ($GLOBALS['WrkDir'] == "") {
        $domainName = $_SERVER['HTTP_HOST'].'/';
    } else {
        $domainName = $_SERVER['HTTP_HOST'].'/'.$GLOBALS['WrkDir'].'/';
    }
    return $protocol.$domainName;
}

function generateMAXID($prefixVal,$numVal,$blnIncrKey,$blnHypen) {
$tmpMaxVal = 
$maxVal = "";
if ($blnIncrKey == "yes") {
$numVal = ($numVal + 1);
} else {
//skip
}

if ($numVal >= 0 && $numVal <= 9) {
$tmpMaxVal = "0000" .$numVal;
} else if ($numVal >= 10 && $numVal <= 99) {
$tmpMaxVal = "000" .$numVal;
} else if ($numVal >= 100 && $numVal <= 999) {
$tmpMaxVal = "00" .$numVal;
} else if ($numVal >= 1000 && $numVal <= 9999) {
$tmpMaxVal = "0" .$numVal;
} else if ($numVal >= 10000 && $numVal <= 99999) {
$tmpMaxVal = "" .$numVal;
}
if ($blnHypen == "yes") {
$maxVal = $prefixVal ."-" .$tmpMaxVal;
} else {
$maxVal = $prefixVal .$tmpMaxVal;
}

return $maxVal;
}

function addDateToDateString($currDate,$intrval) {

//$dateVal = date_create('2019-01-01');
$dateVal = date_create($currDate);
//date_add($date, date_interval_create_from_date_string('1 year 35 days'));
date_add($dateVal, date_interval_create_from_date_string($intrval));
//echo date_format($dateVal, 'Y-m-d');
return date_format($dateVal, 'Y-m-d');
}

function getCurrDateString() {
$dateVal =  date("Y-m-d");
//echo "date : " .$dateVal;

return $dateVal;
}

function formatDate($strDateVal,$frmtVal) {
$dateVal = "";
$date = date_create($strDateVal);
if ($frmtVal == "1") {
$dateVal = date_format($date,"Y-m-d");
} else {
$dateVal = date_format($date,"Y/m/d H:i:s");
}
return $dateVal;
}

function connMySQL($host,$user,$pwd,$db) {
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
  die("<br><br>Connection failed: " . $conn->connect_error ." host: " .$host ." database: " .$db ."<br><br>");
}

//echo "Connected successfully";
return $conn;
} // end func connMySQL

function fetchEntityResultSet($srvrConn,$tsql) {
$resultSet = "";
mysqli_query($srvrConn, "use notflix;");

//echo "<br><br>" .$tsql ."<br><br>";

$resultSet = mysqli_query($srvrConn, $tsql);

//echo "<br><br>" .mysqli_num_rows($resultSet) ."<br><br>";

return $resultSet;
} // fetchEntityResultSet

function fetchEntityMAXIDQuery($srvrConn,$tsql,$keyCol) {
$maxVal = 0;

mysqli_query($srvrConn, "use notflix;");

$resultSet = mysqli_query($srvrConn, $tsql);

if (mysqli_num_rows($resultSet) > 0) {

while($row = mysqli_fetch_assoc($resultSet)) {

//echo "testing";
//echo "MAX - itemCode - videotrack :" .$row["trckID"];
$maxVal = $row[$keyCol];
}

} else {
	echo "Query fetched 0 rows <br>";
}
return $maxVal;

} // end func

function funcEntityInsertQuery($srvrConn,$tsql) {
//$tsql = "INSERT INTO useracctid (UserAcctID,UserName) VALUES ('USR0003','user2') ";

mysqli_query($srvrConn, "use notflix;");

if (mysqli_query($srvrConn, $tsql)) {
  //echo "New record created successfully";
    //echo "Submission successful";
} else {
    echo "Submission unsuccessful: " . $tsql . "<br>" . mysqli_error($srvrConn);
} // if
  
}// end func

function phpHandleSpace($strVal) {
$newVal = preg_replace('/\\s/','|',$strVal);
return $newVal;
}

function phpHandleQuotes($strVal) {
$newVal = str_replace($strVal,"''","'");
return $newVal;
}

function mssql_addslashes($data) { 
    $data = str_replace("'", "''", $data); 
    return $data; 
} 

?>