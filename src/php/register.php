<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="tranCSS-srcFile.css">
<script src="validateFrm.js"></script>

<style>
/*
td {
border: 1px solid black;
}
*/
</style>

</head>
<body>
<?php
include 'connsrvr.php';

$phpRegMnu = $_GET['txtRegMnu'];
$phpUsrVal = $_GET['txtUsrVal'];
/*
echo $phpRegMnu;
echo "<br><br>";

echo $phpUsrVal;
echo "<br><br>";
*/
$maxVal = "";
$currDBMaxVal = "";
$auditDBMaxVal = "";

$auditArr = "";
$auditArr = explode($dlmtr2,$auditDB);

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

$tmpArr = explode($dlmtr1,$userCrdn);

/*
echo $tmpArr[0];
echo "<br>";
echo $tmpArr[1];
echo "<br>";
*/

$dbArr = "";
$dbArr = explode($dlmtr2, $tmpArr[0]);
$colArr = "";
$colArr = explode($dlmtr2, $tmpArr[1]);

$dbName = "";
$dbName = $dbArr[1];
$autoGenKeyCol = "";
$autoGenKeyCol = $dbArr[2];
$keyCol = "";
$keyCol = $dbArr[3]; 
$keyPrefix = "";
$keyPrefix =  $dbArr[4];

/*
echo $dbName;
echo "<br>";
echo $keyCol;
echo "<br>";
echo $keyPrefix;
echo "<br>";
*/
if ($phpRegMnu == "regusr") {

	$conn = connMySQL($servername,$username,$password,$schemaname);

	//echo "<br><br>";
	$tsql1 = "SELECT COALESCE(MAX(" .$autoGenKeyCol ."),0) as " .$autoGenKeyCol ." FROM " .$dbName;
	//echo $tsql1;
	$maxVal = fetchEntityMAXIDQuery($conn,$tsql1,$autoGenKeyCol);
	//autogenkeycol and prefix concat
	$currDBMaxVal = generateMAXID($keyPrefix,$maxVal,"yes","NA");
	//echo "MAX - Code - " .$dbName .":" .$currDBMaxVal;

	//echo "<br><br>";

	//echo $auditArr[0] .$auditArr[1];
	$tsql2 = "Select COALESCE(MAX(" .$auditArr[1] ."),0) as " .$auditArr[1] ." from " .$auditArr[0];
	//echo $tsql2;
	$maxVal = fetchEntityMAXIDQuery($conn,$tsql2,$auditArr[1]);
	//autogenkeycol and prefix concat
	$auditDBMaxVal = generateMAXID($auditArr[3],$maxVal,"yes","NA");
	//echo "MAX - Code - AuditLog :" .$auditDBMaxVal;

	mysqli_close($conn);
} else {
	//skip
} // if 

?>

<div id="regDiv">

</div>

<script>

//alert(logID);
//var mnuVal = "usrreg";
var mnuVal = '<?php echo $phpRegMnu ?>';
var usrVal = '<?php echo $phpUsrVal ?>';

var maxVal = "";
var logID = "";

var tmpArr1 = "";
var tmpArr2 = "";

var dbX = "";

var dbArr = "";
var colInfo = "";

if (mnuVal == "regusr") {
	maxVal = '<?php echo $currDBMaxVal ?>';
	logID = '<?php echo $auditDBMaxVal ?>';
	//alert(maxVal);	

	tmpArr1 = '<?php echo $tmpArr[0] ?>';
	tmpArr2 = '<?php echo $tmpArr[1] ?>';

	dbArr = tmpArr1.split("|");
	colInfo = tmpArr2.split("|");

	dbX = dbArr[1];
}

bindRegisterFrmCtrls(mnuVal,usrVal,maxVal,logID);

function bindRegisterFrmCtrls(mnuVal,usrVal,usrMaxID,logMaxID) {
//alert(tmpArr2);

    divX = document.getElementById("regDiv");
    if (divX == null || divX == undefined || divX == "") {
        //skip
    } else {
        while (divX.firstChild) {
           divX.removeChild(divX.firstChild);
        }
    }

    frmX = document.createElement("form");
    frmX.setAttribute("id","frmReg");
    frmX.setAttribute("name","frmReg");
    frmX.setAttribute("style","width:100%;padding:10px;text-align:left;");
    frmX.setAttribute("method","POST");
    //frmX.setAttribute("style","background:pink;");
    frmX.setAttribute("action","postdata.php");

	var tblX = "";
	tblX = document.createElement("table");
	tblX.setAttribute("id","tblReg");
	tblX.setAttribute("style","background-color:transparent;border-collapse:collapse;margin-left:auto;margin-right:auto;padding5px;text-align:center;");

	elmntX = document.createElement("caption");
	elmntX.setAttribute("style","font-size:20px");
	elmntX.innerHTML = "Register Member";
	tblX.appendChild(elmntX);

	if (mnuVal=="chkusr") {
		rowX = document.createElement("tr");
		rowX.setAttribute("style","width:100%;");

		colX = document.createElement("td");
		colX.setAttribute("style","padding:5px;");
		colX.setAttribute("colspan","2");

		elmntX = document.createElement("label");
		elmntX.setAttribute("id","paraX");
		if (usrVal == "NA") {
			elmntX.setAttribute("style","padding:5px;font-size:16px;color:red;float:right;");	
			elmntX.innerHTML = "User name already exits, try again!";
		} else {
			elmntX.innerHTML = "";
		}	
		colX.appendChild(elmntX);
		rowX.appendChild(colX);
		tblX.appendChild(rowX);

		rowX = document.createElement("tr");
		rowX.setAttribute("style","width:100%;");

		colX = document.createElement("td");
    	colX.setAttribute("style","padding:5px;width:120px;");	

		elmntX = document.createElement("label");
		elmntX.innerHTML = "UserName";

		colX.appendChild(elmntX);
		rowX.appendChild(colX);

		colX = document.createElement("td");
    	colX.setAttribute("style","padding:5px;width:120px;");

		elmntX = document.createElement("input");
		elmntX.setAttribute("id","UserName");
		elmntX.setAttribute("name","UserName");
		elmntX.setAttribute("type","text");
		elmntX.setAttribute("style","background:#e6f5ff;");
		elmntX.setAttribute("value","");

		colX.appendChild(elmntX);
		rowX.appendChild(colX);

		colX = document.createElement("td");
        colX.setAttribute("style","padding:5px;width:120px;");

		elmntY = document.createElement("img");
		elmntY.setAttribute("id","btnChkUsr");		
		elmntY.setAttribute("src","chk-nook-icn.png");
		elmntY.setAttribute("alt","usrnook");
		elmntY.setAttribute("style","width:30px;height:30px;")
		colX.appendChild(elmntY);
		rowX.appendChild(colX);	

		tblX.appendChild(rowX);

	} else if (mnuVal == "regusr"){

        for(i=0;i<colInfo.length;i++) {
	    	colArr = colInfo[i].split("~");

	    	rowX = document.createElement("tr");

	    	if (colArr[1] == "UserAcctID" || colArr[1] == "RegisterDate" || colArr[1] == "ExpiryDate" || colArr[1] == "UserAdmin") {
	        	rowX.setAttribute("style","display:none;");
	    	} else {			
            	rowX.setAttribute("style","width:100%;padding:5px;");
	    	}

	    	colX = document.createElement("td");
        	colX.setAttribute("style","padding:5px;width:120px;");

	    	elmntX = document.createElement("label");
	    	elmntX.innerHTML = colArr[0];

	    	colX.appendChild(elmntX);
	    	rowX.appendChild(colX);

	    	colX = document.createElement("td");
        	colX.setAttribute("style","padding:5px;");

	    	elmntX = document.createElement("label");
	    	elmntX.innerHTML = "&nbsp;&nbsp";

	    	colX.appendChild(elmntX);
	    	rowX.appendChild(colX);

	    	colX = document.createElement("td");
        	colX.setAttribute("style","padding:5px;");

	    	elmntX = document.createElement("input");
	    	elmntX.setAttribute("id",colArr[1]);

	    	if (colArr[1] == "UserPwd" || colArr[1] == "UserAdmin") {
            	elmntX.setAttribute("type","password");
        	} else {
            	elmntX.setAttribute("type","text");
	    	}
	    	elmntX.setAttribute("style","background:#e6f5ff;");

			if (colArr[1] == "UserName") {
				elmntX.value = usrVal;
				elmntX.setAttribute("style","background:#C0C0C0;");
				elmntX.setAttribute("readonly","readonly");
			} else if (colArr[1] == "UserAcctID" || colArr[1] == "RegisterDate" || colArr[1] == "ExpiryDate" || colArr[1] == "UserAdmin") {
            	if (colArr[3] == "NA") {
		    		elmntX.value = maxVal;
				} else {
		    		elmntX.value = colArr[3];
            	}
        	} else {		
				elmntX.value = "";
	    	}
	    	colX.appendChild(elmntX);
			rowX.appendChild(colX);
        	tblX.appendChild(rowX);						
		
			if (colArr[1] == "UserName") {
				colX = document.createElement("td");
        		colX.setAttribute("style","padding:5px;width:120px;");

				elmntY = document.createElement("img");
				elmntY.setAttribute("id","btnChkUsr");		
				elmntY.setAttribute("src","chk-ok-icn.png");
				elmntY.setAttribute("alt","usrok");
				elmntY.setAttribute("style","width:30px;height:30px;")
				colX.appendChild(elmntY);
				rowX.appendChild(colX);			
			} else if (colArr[1] == "UserPwd") {
        		rowX = document.createElement("tr");
				rowX.setAttribute("style","width:100%;padding:5px;");

	    		colX = document.createElement("td");
            	colX.setAttribute("style","padding:5px;width:120px;");

	    		elmntX = document.createElement("label");
	    		elmntX.innerHTML = "Confirm Password";

	    		colX.appendChild(elmntX);
	    		rowX.appendChild(colX);

	    		colX = document.createElement("td");
            	colX.setAttribute("style","padding:5px;");

	    		elmntX = document.createElement("label");
	    		elmntX.innerHTML = "&nbsp;&nbsp";

	    		colX.appendChild(elmntX);
	    		rowX.appendChild(colX);

	        	colX = document.createElement("td");
	        	colX.setAttribute("style","padding:5px;");

				elmntX = document.createElement("input");
				elmntX.setAttribute("id","txtNewPwd");
            	elmntX.setAttribute("type","password");
	        	elmntX.setAttribute("style","background:#e6f5ff;");				

	    		colX.appendChild(elmntX);
				rowX.appendChild(colX);

	        	tblX.appendChild(rowX);
	    	}
		} // for loop
	
    	rowX = document.createElement("tr");
		//rowX.setAttribute("style","width:100%;padding:5px;");
		rowX.setAttribute("style","display:none;");

    	colX = document.createElement("td");
    	colX.setAttribute("style","padding:5px;");

		elmntX = document.createElement("input");
		elmntX.setAttribute("type","text");
		elmntX.setAttribute("name","idVal[]");
		elmntX.setAttribute("readonly","readonly");
		elmntX.setAttribute("value","NA");
		colX.appendChild(elmntX);
		rowX.appendChild(colX);

		colX = document.createElement("td");
    	colX.setAttribute("style","padding:5px;");

		elmntX = document.createElement("input");
		elmntX.setAttribute("type","text");
		elmntX.setAttribute("name","keyVal[]");
		elmntX.setAttribute("readonly","readonly");
		elmntX.setAttribute("value","NA");
		colX.appendChild(elmntX);
		rowX.appendChild(colX);

		colX = document.createElement("td");
    	colX.setAttribute("style","padding:5px;");

		elmntX = document.createElement("input");
		elmntX.setAttribute("type","text");
		elmntX.setAttribute("name","dbVal[]");
		elmntX.setAttribute("readonly","readonly");
		elmntX.setAttribute("value","NA");
		colX.appendChild(elmntX);
		rowX.appendChild(colX);

		colX = document.createElement("td");
    	colX.setAttribute("style","padding:5px;");

		elmntX = document.createElement("input");
		elmntX.setAttribute("type","text");
		elmntX.setAttribute("name","updateVal[]");
		elmntX.setAttribute("readonly","readonly");
		elmntX.setAttribute("value","NA");
		colX.appendChild(elmntX);

		rowX.appendChild(colX);
		tblX.appendChild(rowX);
	} // phpRegMnu

    rowX = document.createElement("tr");
	rowX.setAttribute("style","width:100%;padding:5px;");

	colX = "";
	colX = document.createElement("td");
	colX.setAttribute("style","padding:10px;text-align:center;");

	elmntX = document.createElement("input");
	elmntX.setAttribute("type","hidden");
	elmntX.setAttribute("name","lblMnuVal");
	elmntX.setAttribute("id","lblMnuVal");
	//elmntX.setAttribute("readonly","readonly");
	elmntX.setAttribute("value",mnuVal);
	colX.appendChild(elmntX);
	rowX.appendChild(colX);

    colX = document.createElement("td");
    colX.setAttribute("colspan","2");
    colX.setAttribute("style","padding:5px;");

	elmntX = document.createElement("button");
	elmntX.setAttribute("type","submit");
	elmntX.setAttribute("id","btnReg");
	//elmntX.setAttribute("onclick","checkRegFrm('" + usrMaxID + "','" + logMaxID + "')")
	if (mnuVal == "chkusr") {
		elmntX.setAttribute("value","Check");
		elmntX.innerHTML = "Check user name available";	
	}else if (mnuVal == "regusr") {
		elmntX.setAttribute("style","float:right;");
		elmntX.setAttribute("value","Register");
		elmntX.innerHTML = "Register";	
	}

    colX.appendChild(elmntX);
	rowX.appendChild(colX);

    tblX.appendChild(rowX);

	frmX.appendChild(tblX);
	frmX.setAttribute("onsubmit","return checkRegFrm('" + usrMaxID + "','" + logMaxID + "')");
    
	divX.appendChild(frmX);
} // end func

function checkRegFrm(usrMaxID,logMaxID) {
var blnValidFrm = true;
var valX = "";

validate: {
	if (mnuVal == "chkusr") {
		var txtName = document.getElementById("UserName");
    	if(chkValidName(txtName,true,30,"User name") == false) {
       		blnValidFrm = false;
       		break validate; 
			//exit();
    	}
	} else {
    	//validate user name
    	var txtName = document.getElementById("UserName");
    	if(chkValidName(txtName,true,30,"User name") == false) {
       		blnValidFrm = false;
       		break validate; 
    	}
    
    	//validate last name
    	var txtLName = document.getElementById("LastName");
    	if(chkValidName(txtLName,false,30,"Last name") == false) {
       		blnValidFrm = false;
       		break validate; 
    	}

    	//validate password
    	var txtPwdX = document.getElementById("UserPwd");
    	if (chkValidPassword(txtPwdX,true) == false) {
        	blnValidFrm = false;
        	break validate;
    	}

    	//validate password
    	var txtPwdY = document.getElementById("txtNewPwd");
    	if (chkValidPassword(txtPwdY,true) == false) {
        	blnValidFrm = false;
        	break validate;
    	}

    	if (txtPwdX.value == txtPwdY.value) {
			//skip
    	} else {
       		alert("Confirm password and New password should be same");
       		txtPwdY.focus();
       		blnValidFrm = false;
       		break validate;
    	}

    	//validate email length and is email valid
    	var txtEmail = document.getElementById("UserEmail");
    	if (chkCharLength(txtEmail,40,"User email") == false) {
        	blnValidFrm = false;
        	break validate;
    	}

    	if(chkValidEmail(txtEmail,true) == false) {
       		blnValidFrm = false;
       		break validate;
    	}

    	//validate phone
    	var txtPhone = document.getElementById("UserPhone");
    	if(chkValidPhone(txtPhone,false) == false) {
       		blnValidFrm = false;
       		break validate;
    	}
	}
}

if (blnValidFrm == true) {
	if (mnuVal == "chkusr") {
		//skip
	} else {
		var tblX = document.getElementById("tblReg");

		var cnt = tblX.rows.length;
		var rowData = "";
		var tmpX = "";

		for (i=0;i<cnt-2;i++) {
	    	rowData = tblX.rows[i].cells;
	     	//alert(rowData.length);

	     	if (rowData[2].firstChild.id == "txtNewPwd") {
            	//skip
            } else {
                if (rowData[2].firstChild.value == "") {
                    tmpX = "NA";
                } else {
                    tmpX = rowData[2].firstChild.value;
                }
                if (valX == "") {
                    //alert(rowData[2].firstChild);
                    valX = rowData[2].firstChild.id + "|NA|" + tmpX;
                } else {
                    valX = valX + "||" + rowData[2].firstChild.id + "|NA|" + tmpX;
         		}
        	}// if
		}// for loop
    	//alert(valX);
    	bindAuditLogData(valX,usrMaxID,logMaxID);
	}
}

return  blnValidFrm;
} //end func

function bindAuditLogData(valX,usrMaxID,logMaxID) {

var valArr = "";
var valArr = document.getElementsByName("idVal[]");
valArr[0].value = logMaxID;

var valArr = document.getElementsByName("dbVal[]");
valArr[0].value = "UserAcct|Append|yes";

var valArr = document.getElementsByName("keyVal[]");
valArr[0].value = "keyVal|UserAcctID|" + usrMaxID;

var valArr = document.getElementsByName("updateVal[]");
//var valX = "New//valArr[0].value;
var valY = "New member registration successful, new record appended-" + dbX + "-" + "UserAcctID" + "-" + usrMaxID;

var valZ = valY + "~" + valX;
valArr[0].value = valZ;

//alert(valZ);
}

</script>
</body>
</html>