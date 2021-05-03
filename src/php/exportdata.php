<?php

include 'connsrvr.php';

$mnuVal = $_POST['txtMnuVal'];

//$mnuVal = "user";
//echo $mnuVal ."<br>";

$tempArr = "";
switch ($mnuVal) {
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
echo $tempArr;
echo "<br><br>";

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

function funcFetchData($srvrConn)
{
$setData = "";
$value = "";
$columnHeader = "";
$rowData = "";

$tsql = "Select * from " .$GLOBALS['dbName'];

//echo $tsql ."<br><br>";

$result = fetchEntityResultSet($srvrConn,$tsql);
$rowCnt = 0;
if (mysqli_num_rows($result) > 0) {
        $timestamp = time();        
        //$filename = $GLOBALS['dbName'] .'_' . $timestamp . '.csv';
        $filename = $GLOBALS['dbName'] .'_' . $timestamp . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");  
        header("Expires: 0");

        $isPrintHeader = false;
        while($row = mysqli_fetch_assoc($result)) {
                if (! $isPrintHeader) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t", array_values($row)) . "\n";
        }// while   
} else {
    echo "Query fetched 0 rows <br>";
} // if num of rows > 0

mysqli_free_result($result);
exit();
} // end func

$conn = connMySQL($servername,$username,$password,$schemaname);

funcFetchData($conn);

mysqli_close($conn);

?>