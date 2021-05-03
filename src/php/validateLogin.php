
<?php
include 'connsrvr.php';

session_start();
$_SESSION['currUsrRS'] = "";

$frmUsrID = $_GET['txtUsr'];
$frmUsrPwd = $_GET['txtPwd'];
$frmMnuVal = $_GET['txtPage'];

/*
echo $frmUsrID; 
echo "<br>";
echo $frmUsrPwd; 
echo "<br>";
echo $frmMnuVal; 
echo "<br>";
*/

$auditArr = "";
$auditArr = explode($dlmtr2,$auditDB);
$auditDBMaxVal = "";

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

//echo $loginCrdn;

$currUsr = "";
$currUsrAddr = "";

$usrID = "";
$usrPwd = "";
$usrName = "";
$usrType = "";
$msgVal = "";
$urlVal = siteURL();

$tempArr = explode($GLOBALS['dlmtr2'],$loginCrdn);

$dbName = "";
$dbName = $tempArr[0];
$usrNameCol = "";
$usrNameCol = $tempArr[1]; 
$usrPwdCol = "";
$usrPwdCol = $tempArr[2]; 
$usrTypeCol = "";
$usrTypeCol = $tempArr[3]; 

/*
echo $dbName;
echo "<br><br>";
echo $usrNameCol;
echo "<br><br>";
echo $usrPwdCol;
echo "<br><br>";
*/

$validLogin = "no";
$pwdValid ="no";
$usrValid = "no";

function funcFetchLoginData($srvrConn,$srchCol,$txtUsrVal,$checkCol,$txtUsrPwd,$usrAdminCol)
{

//echo "testing<br><br>";

$tsql = "Select * from " .$GLOBALS['dbName'] ." where " .$srchCol ." = '" .$txtUsrVal ."' ";
//echo $tsql;

$result = fetchEntityResultSet($srvrConn,$tsql);

if (mysqli_num_rows($result) > 0) {
	//echo "Query fetched ". mysqli_num_rows($result) ." rows <br>";

    while($row = mysqli_fetch_assoc($result)) {
	$GLOBALS['usrValid'] = "yes";
/*
	   echo "Welcome " .$GLOBALS['frmUsrID'] ."<br>";
	   echo "Welcome " .$GLOBALS['frmUsrPwd'] ."<br><br>";

	   echo "Welcome " . $row[$srchCol] ."<br>";
	   echo "Welcome " . $row[$checkCol] ."<br>";
*/

	$valX = $row[$checkCol];
	$hash = base64_decode ($valX);
	$row[$checkCol] = $hash;
	//echo "<b>" .$row[$checkCol] ."<br>";

        if($row[$checkCol] == $GLOBALS['frmUsrPwd']) {

	   $GLOBALS['pwdValid'] = "yes";
	   $GLOBALS['validLogin'] = "yes";

/*
	   echo "Welcome " . $row[$srchCol] ."<br>";
	   echo "Welcome " . $row[$checkCol] ."<br>";
*/
           $GLOBALS['msgVal'] = "validUser";
	   //showUsrMenu($row,$srchCol,$usrAdminCol);
 	   $GLOBALS['usrName'] = $row[$srchCol];
	   $GLOBALS['usrType'] = $row[$usrAdminCol];
	   $GLOBALS['usrID'] = $row['UserAcctID'];
	   $GLOBALS['usrPwd'] = $row['UserPwd'];
           assingRSValue($row);
	}
    }

    if ($GLOBALS['usrValid'] == "no") {
	//echo "Enter a valid user";
 	$GLOBALS['msgVal'] = "Enter a valid user";
    } else if ($GLOBALS['pwdValid'] == "no") {
	//echo "Enter a valid password";
	$GLOBALS['msgVal'] = "Enter a valid password";
    } else {
	//skip
    } // usr or pwd not valid
} else {
	//echo "Query fetched 0 rows <br>";
$GLOBALS['msgVal'] = "Enter a valid user";
} // if num of rows > 0
mysqli_free_result($result);

} // end func

function assingRSValue($rs) {
$_SESSION['currUsrRS'] = $rs;
} // end func


	$conn = connMySQL($servername,$username,$password,$schemaname);

	funcFetchLoginData($conn,$usrNameCol,$frmUsrID,$usrPwdCol,$frmUsrPwd,$usrTypeCol);

	$tsql2 = "Select COALESCE(MAX(" .$auditArr[1] ."),0) as " .$auditArr[1] ." from " .$auditArr[0];
	//echo $tsql2;
	$maxVal = fetchEntityMAXIDQuery($conn,$tsql2,$auditArr[1]);
	//autogenkeycol and prefix concat
	$auditDBMaxVal = generateMAXID($auditArr[3],$maxVal,"NA","NA");
	//echo "MAX - Code - AuditLog :" .$auditDBMaxVal;

	mysqli_close($conn);
?>

<script>
function validateUser() {
var msgVal = "";
var strMsg = '<?php echo $GLOBALS['msgVal'] ?>';
//alert(strMsg);
if (strMsg == "validUser") {
var valX = '<?php echo $GLOBALS['usrName'] ?>' + "|" + '<?php echo $GLOBALS['usrType'] ?>' + "|" + 'yes';
elmntX = parent.document.getElementById("lblUsrType");
elmntX.value = valX;
valX = '<?php echo $GLOBALS['usrID'] ?>';
elmntX = parent.document.getElementById("lblUsrID");
elmntX.value = valX;

valX = '<?php echo $GLOBALS['usrPwd'] ?>';
elmntX = parent.document.getElementById("lblUsrPwd");
elmntX.value = valX;

valX = '<?php echo $auditDBMaxVal ?>';
elmntX = parent.document.getElementById("lblLogID");
elmntX.value = valX;

parent.onUserChanged("logged");

mnuVal = '<?php echo $frmMnuVal ?>';
usrName = '<?php echo $frmUsrID ?>';

if (mnuVal == 'login') {

tempX = parent.document.getElementById("mnuHome");
//alert(tempX.id);
tempX.click();

} else {
//var urlPath = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
var urlPath = sessionStorage.siteDomainName;
//document.write(urlPath + "<br><br>");
//var urlFile = "php-srcFiles/phpWelcome.php?usrMsg=" + msgVal;
var urlFile = "src/php/userprofile.php?txtUsr=" + usrName + "&mnuVal=" + mnuVal;
//document.write(urlFile + "<br><br>");
//var hrefVal = urlPath + "/" + urlFile;
var hrefVal = urlPath + urlFile;
//document.write(hrefVal + "<br><br>");
//alert(hrefVal);
window.location.href = hrefVal;
}

} else {
msgVal = "msg" + "|" + strMsg + "|" + "no";

//var urlPath = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port;
var urlPath = sessionStorage.siteDomainName;
//document.write(urlPath + "<br><br>");
//var urlFile = "php-srcFiles/phpWelcome.php?usrMsg=" + msgVal;
var urlFile = "src/php/welcome.php?usrMsg=" + msgVal + "&mnuOpt=login";
//document.write(urlFile + "<br><br>");
//var hrefVal = urlPath + "/" + urlFile;
var hrefVal = urlPath + urlFile;
//document.write(hrefVal + "<br><br>");
//alert(hrefVal);
window.location.href = hrefVal;
} // if strMsg == validUser
} // end func

validateUser();
</script>