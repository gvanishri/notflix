<html>

<?php
//echo "testing";

$phpUsrID = $_POST['txtUsr'];
$phpUsrPwd = $_POST['txtPwd'];
$phpMnuVal = $_POST['txtPage'];

//echo "Welcome Login:" .$phpUsrID ."<br><br>";
//echo "Welcome Login:" .$phpUsrPwd ."<br><br>";

$_GET['txtUsr'] = $phpUsrID;
$_GET['txtPwd'] = $phpUsrPwd;
$_GET['txtPage'] = $phpMnuVal;

include 'validateLogin.php';
?>

</html>