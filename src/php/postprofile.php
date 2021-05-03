
<html>

<?php
include 'connsrvr.php';

//echo "testing";

function funcUserAcctInsertStmt($srvrConn) {


funcEntityInsertQuery($srvrConn,$testSQL);

} // end func

$conn = funcConnSqlSrvr($serverName,$connectionInfo);

funcUsreAcctInsertStmt();

sqlsrv_close($conn);
?>

<script>

onUserMnuBtnClick('usrAcct','div1');

</script>
</html>
