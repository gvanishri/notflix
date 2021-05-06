
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="tranCSS-srcFile.css">
<script src="tranFrm-srcFile.js"></script>
</head>

<body id="frmTrckLst">

<?php
$usrInfo = $_GET['usrInfo'];

$_GET['usrData']=$usrInfo;
include 'fetchtrack.php';
?>

<!-- The Modal -->
<div id="popupDiv" class="modal">

</div>
</body>
</html>