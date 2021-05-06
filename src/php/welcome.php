
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
font-size:12px;font-family:verdana,Helvetica,sans-serif;
}

p {
text-align:center;
padding:3px;
}

#txtUsr, #txtPwd {
width:230px;height:30px;outline:none;border:0px solid;border-radius:5px;background-color:#e6f5ff;
}

#btnLogin {
padding:7px;outline:none;border:0px;background-color:#e6f5ff;
}

#btnLogin:hover, #btnLogin:active, #lnkLogin:hover, lnkLogin:active {
border-bottom : 2px solid black;
cursor: pointer;
}

#loginImg {
width:230px;height:200px;padding:10px;vertical-align:middle;
}

</style>

</head>

<body>
<?php
include 'connsrvr.php';

$phpUsrMsg = $_GET['usrMsg'];
$phpMnuVal = $_GET['mnuOpt'];

$arr = explode($dlmtr2,$phpUsrMsg);

if ($arr[0] == "msg") {
echo "<p>" .$arr[1] ."</p>";
loadLoginPage('msg');
} else if ($arr[0] == "guest") {
loadLoginPage('guest');
} else {
redirectPage($arr[0],$phpMnuVal);
}

function loadLoginPage($strVal) {
$urlVal = siteURL();
$imgSrc = $urlVal ."images/imgLogin.jpg";
//echo $imgSrc; 
echo "<p><img id='loginImg' src='" .$imgSrc ."' alt='login'></img></p>";

echo "<form id='frmLogin' method='POST' action='login.php'>";

echo "<p style='font-size:14px;font-weight:bold;'> Welcome </p>";

echo "<p><input type='hidden' id='txtPage' name='txtPage' value='login'/></p>";

echo "<p><input type='text' id='txtUsr' name='txtUsr' placeholder='username' value=''/></p>";

echo "<p><input type='password' id='txtPwd' name='txtPwd' placeholder='password' value=''/></p>";

echo "<p><input type='submit' id='btnLogin' name='btnLogin' value='LOGIN'/></p>";

echo "<p><a id='lnkLogin' href='register.php?txtRegMnu=chkusr&txtUsrVal=new'> Do you have an account? Sign-up </a></p>";

echo "</form>";
} // end func

function redirectPage($usrName,$mnuVal) {
$urlVal = siteURL();
//echo $usrVal;
//header("Location: " .$urlVal ."php-srcFiles/phpProfile.php?txtUsr=" .$usrName);
header("Location: " .$urlVal ."src/php/userprofile.php?txtUsr=" .$usrName ."&mnuVal=" .$mnuVal);
//exit();
}

?>


</body>
</html>