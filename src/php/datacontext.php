
<html>
<head>
<link rel="stylesheet" href="tranCSS-srcFile.css">
<script src="tranFrm-srcFile.js"></script>
<script src="validateFrm.js"></script>

</head>

<body id="frm">

<?php
$phpName = $_GET['name'];
//echo $txtName;
include 'fetchdata.php';
?>
<style>
#maxID {
display:none;
//display:block;
}

#divFrm {
display:none;
text-align:center;
}
}
</style>


<div id="divFrm">
<form id="frmAction" method="post" action="postdata.php" enctype="multipart/form-data">
<p>
<table id="frmAudit" style="display:none;"></table> 
</p>
<p>
<table id="frmTrckAudit" style="display:none;"></table> 
</p>
<p style="display:none;"> Menu Selected : <input type="text" name="lblMnuVal" readonly value='<?php echo $phpName ?>'> </input> </p>
<input type="submit" id="btnSave" value="CLICK SAVE - COMMIT CHANGES"></button>
</p>

</form>
</div>

<script type="application/javascript">
var jsdlmtr = "|";

document.getElementById("divFrm").style.display = "none";

strColor = sessionStorage.clrSelected;
var themeClr = parent.getColorPalatte(strColor);
var clrVal = "";
var clrName = "";

if (themeClr == null || themeClr == undefined) {
//skip
} else {
clrName = strColor + "_clrLight";
clrVal = themeClr[clrName].bgColor;
}

function setColor(strColor,clrOpt,tagVal) {
var thArr = document.getElementsByTagName("th");
var tempX = "";
    if (thArr == null || thArr == undefined) {
        //skip
    } else {
    //alert(thArr.length);

        //clrVal = "#99d6ff";
	clrName1 = strColor + "_clrLight";
	clrVal1 = themeClr[clrName1].bgColor;

       for (i=0;i<thArr.length;i++) {
            tempX = document.getElementById(thArr[i].id);
            if (tempX == null || tempX == undefined) {
                //skip
            } else {
                tempX.style.backgroundColor = clrVal1;
            }
        } //for loop
    } // thArr null
}// end func

function exportData() {

    var mnuVal = '<?php echo $phpName ?>';

    frm = document.createElement("form");
    frm.setAttribute("name","frmExport");
    frm.setAttribute("method","POST");
    frm.setAttribute("action","exportdata.php");

    elmntX = document.createElement("input");
    elmntX.setAttribute("type","hidden");
    elmntX.setAttribute("name","txtMnuVal");
    elmntX.setAttribute("id","txtMnuVal");
    elmntX.setAttribute("value",mnuVal);

    frm.appendChild(elmntX);
    alert(elmntX.value);
    document.body.appendChild(frm);
    frm.submit();
}


function validateFrmData(dbX,strMode,tblX,indxVal) {
validFrm = "yes";
editedFrm = "no";
//alert(strMode);
    validate : {
        var rowData = tblX.rows[indxVal].cells;

        if (dbX == "useracct") {

            if (strMode == "Append") {
                tempY = document.getElementById(dbX + "UserName");

                if(chkValidName(tempY,true,30,"User name") == false) {
                    validFrm = "no";
                    break validate; 
                } else {
                    //skip
                }

	        //validate password
    	        var txtPwdX = document.getElementById(dbX + "UserPwd");
    	        if (chkValidPassword(txtPwdX,true) == false) {
                    validFrm = "no";
                    break validate;
	        }

    	        //validate password
	        var txtPwdY = document.getElementById("txtNewPwd");
	        if (chkValidPassword(txtPwdY,true) == false) {
                    validFrm = "no";
                    break validate;
                }

                if (txtPwdX.value == txtPwdY.value) {
	            //skip
                } else {
                    alert("Confirm password and New password should be same");
                    txtPwdY.focus();
                    validFrm = "no";
                    break validate;
	        }
            }

            var strName = dbX + "LastName" + indxVal + "-oldval";
            tempX = document.getElementById(strName);
            tempY = document.getElementById(dbX + "LastName");

            if(chkValidName(tempY,false,30,"Last name") == false) {
                validFrm = "no";
                break validate;
            } else {
                //skip
            }

            if(tempX.innerHTML == tempY.value && strMode == "Edit") {
                //skip
            } else {
                editedFrm = "yes";
            }

            var strName = dbX + "UserEmail" + indxVal + "-oldval";
            //alert(strName);
            tempX = document.getElementById(strName);
            //alert(tempX);
            tempY = document.getElementById(dbX + "UserEmail");

            if (chkCharLength(tempY,40,"User email") == false) {
                validFrm = "no";
                break validate;
            }

            if(chkValidEmail(tempY,true) == false) {
                validFrm = "no";
                break validate;
            } else {
                //skip
            }

            if(tempX.innerHTML == tempY.value && strMode == "Edit") {
                //alert("No changes done");
            } else {
                editedFrm = "yes";
            }

            var strName = dbX + "UserPhone" + indxVal + "-oldval";
            //alert(strName);
            tempX = document.getElementById(strName);
            //alert(tempX);
            tempY = document.getElementById(dbX + "UserPhone");
            if(chkValidPhone(tempY,false) == false) {
                validFrm = "no";
                break validate;
            } else {
                //skip
            }

            if(tempX.innerHTML == tempY.value && strMode == "Edit") {
                //skip
            } else {
                editedFrm = "yes";
            }

        } else if (dbX == "videotrack") {

            var strName = dbX + "TrackTitle" + indxVal + "-oldval";
            tempX = document.getElementById(strName);
            tempY = document.getElementById(dbX + "TrackTitle");

            if(chkValidTitle(tempY,true,60,"Track title") == false) {
                validFrm = "no";
                break validate;
            } else {
                //skip
            }

            if(tempX.innerHTML == tempY.value && strMode == "Edit") {
                //skip
            } else {
                editedFrm = "yes";
            }

            var strName = dbX + "TrackDesc" + indxVal + "-oldval";
            tempX = document.getElementById(strName);
            tempY = document.getElementById(dbX + "TrackDesc");
            if (chkCharLength(tempY,200,"TrackDesc") == false) {
                validFrm = "no";
                break validate;
            }

            if(tempX.innerHTML == tempY.value && strMode == "Edit") {
                //skip
            } else {
                editedFrm = "yes";
            }

            var tmpX = document.getElementById(dbX + "trckSrcFile");

            if(tmpX.files.length == 0 && strMode == "Append") {
                alert("No file selected for upload");
                validFrm = "no";
                break validate;
            }

            tempX = document.getElementById(dbX + "trckSrcLbl");
            tempY = document.getElementById(dbX + "trckDestLbl");

            if (tempY.innerHTML == "NA") {
                //skip
            } else if (tempX.innerHTML == tempY.innerHTML) {
                //skip
            } else {
                editedFrm = "yes";
            }

        } // dbX

        if (editedFrm == "no" && strMode == "Edit") {
            alert("No changes done");
            validFrm = "no";
        }
    } //label validate
return validFrm;
}

function closePopupFrm() {
var divX = document.getElementById("popupDiv");
divX.style.display = "none";

var divY = document.getElementById("popupFrm");
if (divY == null || divY == "" || divY == undefined) {
//skip
} else {
removeAllChildNodes(divY);
divX.removeChild(divY);
}
}

function showPopupFrm(tranMode,dbX,selIndx) {
//alert("Hello It works : tranMode: " + tranMode + " dbName: " + dbX + " selIndx: " + selIndx);
//alert(document.getElementById("popupDiv"));

closePopupFrm();

var tblX = document.getElementById("frmData");

var divX = document.getElementById("popupDiv");
divX.style.display = "block";

divY = document.createElement("div");
divY.setAttribute("class","modal-content");
divY.setAttribute("id","popupFrm");
divY.style.background = clrVal;

var elmntX = "";

elmntX = "";
elmntX = document.createElement("span");
elmntX.setAttribute("class","close");
elmntX.innerHTML = "&times";
elmntX.setAttribute("onclick","closePopupFrm()");
divY.appendChild(elmntX);

divX.appendChild(divY);

var strFrm = "";
    var result = parent.getCounter();
    if (tranMode == 'append' || tranMode == "edit") {
        if (result == 1 && dbX == 'videotrack') {
            alert("Cannot append or edit more than one record at a time, due to server POST data limit, while uploading files");
            closePopupFrm();
        }
    }
    if (tranMode == 'append') {
        showAppendnEditPopupDiv(tranMode,dbX,tblX,'1',divY);
    } else if (tranMode == 'edit') {
        showAppendnEditPopupDiv(tranMode,dbX,tblX,selIndx,divY);
    } else if (tranMode == 'delete') {
        if (tblX.rows.length == 3) {
            alert("Cannot delete, must have atleast one record for data maintainace");
            closePopupFrm();
        } else {
            showDeletePopupDiv(dbX,tblX,selIndx,divY);
        }
    }
} // end func

function showAppendnEditPopupDiv(tranMode,dbX,tblX,indxVal,divY) {

var rowData = tblX.rows[indxVal].cells;

//alert(tblX.rows[indxVal].innerHTML);

var hdrX = document.getElementById("hdrID");
//alert(hdrX.childNodes[0].innerHTML);
var colName = "";
var valX = "";
var srcX = "";
colName = hdrX.childNodes[0].id;

var strVal = "";

tblY = document.createElement("table");
tblY.setAttribute("id","popuptbl");
tblY.setAttribute("style","font-size:12px;border-collapse:collapse;");

tempX = document.getElementById("capID");
tblCaption = document.createElement("caption");
tblCaption.innerHTML = tempX.innerHTML;
tblY.appendChild(tblCaption);

var colCnt = hdrX.childNodes.length;
//alert(colCnt);

for (var i=0;i<colCnt;i++) {

    colName = "";
    colName = hdrX.childNodes[i].id;
    //alert(colName);

    rowX = "";
    rowX = document.createElement("tr");

    colX = "";
    colX = document.createElement("td");

    valX = "";
    valX = hdrX.childNodes[i].innerHTML;

    elmntX = "";
    elmntX = document.createElement("label");
    elmntX.setAttribute("id",dbX + "" + "lbl" + i);
    elmntX.innerHTML = valX;

    colX.appendChild(elmntX);
    rowX.appendChild(colX);

    if (colName == 'UserPwd' && tranMode == "append") {
    	//elmntX = "";
    	elmntX = document.createElement("br");
    	colX.appendChild(elmntX);

    	elmntX = document.createElement("br");
    	colX.appendChild(elmntX);

    	elmntX = document.createElement("br");
    	colX.appendChild(elmntX);

    	elmntX = "";
    	elmntX = document.createElement("label");
    	elmntX.setAttribute("id","lblNewPwd");
    	elmntX.innerHTML = "Confirm password";

    	colX.appendChild(elmntX);
    	rowX.appendChild(colX);
    } 

    colX = "";
    colX = document.createElement("td");

    if (colName == 'TrackSrc') {
        colX.style = "position:relative;";
    }

    valX = "";
    if (tranMode == 'edit') {
        var tagVal = rowData[i].childNodes[0].tagName.toLowerCase();

        if  (tagVal == "label") {
            valX = rowData[i].childNodes[0].innerHTML;
        } else {
            valX = rowData[i].childNodes[0].value;
        }
        //alert(valX);
    } else if (tranMode == 'append') {
        valX = "";
    }

    var srcX = ""; 
    if (colName == 'TrackSrc' && tranMode == "edit") {
        srcX = urlVal + valX;
    }

    var isEditable = rowData[i].childNodes[1].innerHTML;
        //alert(isEditable);

    elmntX = "";

    if (colName == 'TrackDesc') {
        //alert("ItemDesc");
        elmntX = document.createElement("textarea");
        elmntX.setAttribute("rows","3");
        elmntX.setAttribute("cols","60");
        elmntX.value = valX;
    } else if (colName == 'TrackSrc') {
        //alert("TrackSrc");
        elmntX = document.createElement("video");
        elmntX.setAttribute("height","150px");
        elmntX.setAttribute("width","200px");
        elmntX.setAttribute("src",srcX);
        //elmntX.setAttribute("controls","controls");
        //alert(srcX);
    } else {
        elmntX = document.createElement("input");
        if (colName == 'UserPwd' || colName == 'UserAdmin') {
            elmntX.setAttribute("type","password");
        } else {
            elmntX.setAttribute("type","text");
        }
        elmntX.value = valX;

        if (tranMode == "append") {
            var keyCol = document.getElementById("dbKeyCol").innerHTML;
            if (colName == keyCol) {
                var tempX = document.getElementById("dbMaxVal");
                //alert(tempX.innerHTML);
                var strVal = tempX.innerHTML;
                maxVal = funcGetMaxVal(strVal,false);
                tempX.innerHTML = maxVal;
                elmntX.value = maxVal;
            } 

            var defaultVal = rowData[i].childNodes[2].innerHTML

            if (defaultVal == "NA") {
                //skip
            } else {
                elmntX.value = defaultVal;
            }
        } // tranMode == append 
    } // if colName == TrackDesc / TrackSrc, else
    elmntX.setAttribute("id",dbX + colName);

    if (tranMode == "append") {
        if (isEditable == "readonly") {
	    if (colName == 'UserPwd' && tranMode == "append") {
	        elmntX.style.background = "#e6f5ff";
	    } else {
                elmntX.setAttribute("readonly","readonly");                
	    }
        } else {
            elmntX.style.background = "#e6f5ff";
        }
    } else {
        if (isEditable == "enable"){
            elmntX.style.background = "#e6f5ff";
        } else {
            elmntX.setAttribute("readonly","readonly");
        }
    } // if tranMode == append else edit

    if (tranMode == "append" && colName == 'TrackSrc') {
        elmntX.style.display="none";
    }
    colX.appendChild(elmntX);

    if (colName == 'UserPwd' && tranMode == "append") {
        elmntX = document.createElement("br");
	colX.appendChild(elmntX);

	elmntX = document.createElement("br");
	colX.appendChild(elmntX);

	elmntX = document.createElement("input");
	elmntX.setAttribute("id","txtNewPwd");
	elmntX.setAttribute("type","password");
	//elmntX.setAttribute("placeholder","Confirm password");
	elmntX.setAttribute("value","");
	elmntX.style.background = "#e6f5ff";
    }
    colX.appendChild(elmntX);

    if (colName == 'TrackSrc') {
        elmntX = document.createElement("p");
        colX.appendChild(elmntX);

        elmntX = document.createElement("label");
        elmntX.setAttribute("id",dbX + "trckSrcLbl");
        elmntX.innerHTML = valX;
        colX.appendChild(elmntX);

        elmntX = document.createElement("p");
        if (tranMode == "append") {
            elmntX.innerHTML = "Select Video";
        } else {
            elmntX.innerHTML = "Replace Video";
        }
        colX.appendChild(elmntX);

        elmntX = document.createElement("input");
        elmntX.setAttribute("type","file");
        elmntX.setAttribute("id",dbX + "trckSrcFile");
        elmntX.setAttribute("accept","video/*");
        //elmntX.setAttribute("controls","controls");
        elmntX.setAttribute("onchange","loadFile(event,'" + dbX + "')");
        colX.appendChild(elmntX);

        elmntX = document.createElement("p");
        colX.appendChild(elmntX);

        elmntX = document.createElement("br");
        colX.appendChild(elmntX);

        elmntX = document.createElement("video");
        elmntX.setAttribute("id",dbX + "output");
        elmntX.style.background = "#e6f5ff";
        elmntX.setAttribute("height","150px");
        elmntX.setAttribute("width","200px");
        colX.appendChild(elmntX);

        elmntX = document.createElement("br");
        colX.appendChild(elmntX);

        elmntX = document.createElement("label");
        elmntX.setAttribute("id",dbX + "trckDestLbl");
        elmntX.innerHTML = "NA";
        colX.appendChild(elmntX);

        elmntX = document.createElement("br");
        colX.appendChild(elmntX);
    }

    rowX.appendChild(colX);

    tblY.appendChild(rowX);
} // for loop

rowX = "";
rowX = document.createElement("tr");
rowX.style.textAlign = "right";

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","2");

elmntX = document.createElement("button");

if (tranMode == "edit") {
    var keyCol = hdrX.childNodes[0].id;
    elmntX.setAttribute("id",dbX + "" + "btnEdit");
    elmntX.setAttribute("onclick","funcOnEditClick(" + tblX.id + ",'"+ dbX + "','" + keyCol + "'," + indxVal + ")");
    elmntX.innerHTML = "Edit";
} else if (tranMode == "append") {
    elmntX.setAttribute("id",dbX + "" + "btnNew");
    elmntX.setAttribute("onclick","funcOnAppendClick(" + tblX.id + ",'"+ dbX + "','" + keyCol + "')");
    elmntX.innerHTML = "Append";
} // if tranMode
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblY.appendChild(rowX);

divY.appendChild(tblY);
} //end func


var loadFile = function(event,dbX) {
	var inputfile = document.getElementById(dbX+'trckSrcFile');

    if(inputfile.files.length == 0 ){
        //skip
    } else {
        var vid = document.getElementById(dbX+'output');
        const file = event.target.files[0];
        var strFileName = file.name;
        var strFileExt = strFileName.split('.').pop();
        //alert("name: " + strFileName + " , file extension: " + strFileName.split('.').pop());
        //event.target.files[0].name = "img00001."+strFileExt;
	var srcVal = URL.createObjectURL(event.target.files[0]);
        //alert(srcVal);
	    vid.src = URL.createObjectURL(event.target.files[0]);
        vid.alt = "replaceVideo";
        var tempX = document.getElementById("trckDestSrc");
        var valX = tempX.innerHTML;
        var tempX = document.getElementById("trckSrcName");
        var valY = funcGetMaxVal(tempX.innerHTML,true);
        var valZ = valX + valY + "." + strFileExt;
	var lblX = document.getElementById(dbX+'trckDestLbl');
        lblX.innerHTML = valZ;
    }
};

function showDeletePopupDiv(dbX,tblX,selIndx,divY) {

//alert("Hello It works : dbName: " + dbX + " tblX: " + tblX.id + " selIndx: " + selIndx + " divY: " + divY);
//var rowCnt = tblX.rows.length;
//alert(rowCnt);
var rowData = tblX.rows[selIndx].cells;
//alert(rowData.innerHTML);
//alert(rowData[0].firstChild.id);

tempX = document.getElementById("hdrID");
//alert(tempX.childNodes[0].innerHTML);
var colName = "";
colName = tempX.childNodes[0].id;

var keyLblID = dbX+colName+selIndx;

if (keyLblID == rowData[0].childNodes[0].id) {
//alert("Hello It works : keyLblId :" + keyLblID + " rowData - firstChild - ID :" + rowData[0].childNodes[0].id);

tblY = document.createElement("table");
tblY.setAttribute("id","popuptbl");
tblY.setAttribute("style","font-size:12px;border-collapse:collapse;");

tempX = document.getElementById("capID");
tblCaption = document.createElement("caption");
tblCaption.innerHTML = tempX.innerHTML;
tblY.appendChild(tblCaption);

rowX = "";
rowX = document.createElement("tr");

colX = "";
colX = document.createElement("td");

elmntX = "";
elmntX = document.createElement("label");
elmntX.setAttribute("id",dbX + "" + "lbl" + 0);
elmntX.innerHTML = colName;

colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");

var strVal = "";
//alert(rowData[0].childNodes[0].innerHTML);
//strVal = rowData[0].childNodes[0].innerHTML;
var tagVal = rowData[0].childNodes[0].tagName.toLowerCase();

if  (tagVal == "label") {
strVal = rowData[0].childNodes[0].innerHTML;
} else {
strVal = rowData[0].childNodes[0].value;
}

elmntX = "";
elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("id",dbX + colName);
elmntX.setAttribute("readonly","readonly");
elmntX.value = strVal;

colX.appendChild(elmntX);
rowX.appendChild(colX);

tblY.appendChild(rowX);

rowX = "";
rowX = document.createElement("tr");

colX = "";
colX = document.createElement("td");

elmntX = "";
elmntX = document.createElement("label");
elmntX.setAttribute("id",dbX + "" + "lbl" + 1);
elmntX.innerHTML = "Reason";

colX.appendChild(elmntX);
rowX.appendChild(colX);

colX = "";
colX = document.createElement("td");

elmntX = "";
elmntX = document.createElement("textarea");
elmntX.setAttribute("id",dbX+"Reason");
elmntX.setAttribute("rows","2");
elmntX.setAttribute("cols","50");
elmntX.style.height = "40px";
elmntX.style.background = "#e6f5ff";

colX.appendChild(elmntX);
rowX.appendChild(colX);

tblY.appendChild(rowX);

rowX = "";
rowX = document.createElement("tr");
rowX.style.textAlign = "right";

colX = "";
colX = document.createElement("td");
colX.setAttribute("colspan","2");

elmntX = document.createElement("button");
elmntX.setAttribute("id",dbX + "" + "btnDelete");
elmntX.setAttribute("onclick","funcOnDeleteClick('"+ dbX + "','" + colName + "'," + selIndx + ")");
elmntX.innerHTML = "Delete";

colX.appendChild(elmntX);
rowX.appendChild(colX);

tblY.appendChild(rowX);

divY.appendChild(tblY);
} else {
//skip
}
}// end func

function funcOnAppendClick(tblX,dbX,keyCol) {
//alert("Hello it works!");

var isValidData = "no";
isValidData ="yes";

if (isValidData == "yes") {

onConfirmClickUpdate("Append",dbX,keyCol,tblX,"1");

} else {
// skip
}

} // end func

function funcOnEditClick(tblX,dbX,keyCol,selIndx) {
//alert("Hello it works!");
var isValidData = "no";
isValidData = "yes";

if (isValidData == "yes") {

onConfirmClickUpdate("Edit",dbX,keyCol,tblX,selIndx);

} else {
// skip
}

} // end func

function funcOnDeleteClick(dbX,keyCol,selIndx) {
//alert("onDeleteClick");
var strVal = "";
var rsnVal = "";
var idVal = "";

//alert(document.getElementById(name).value);
rsnVal = document.getElementById(dbX + "Reason").value;
if (rsnVal == null || rsnVal == "" || rsnVal == undefined) {
alert("Enter a reson to confirm deletion");
} else {

onConfirmClickUpdate("Delete",dbX,keyCol,"NA",selIndx);

} // if reason is not null

} // end func

function onConfirmClickUpdate(strMode,dbX,keyCol,tblX,currIndx) {
var valZ = "";
var res = false;


if (strMode == "Append" || strMode == "Edit") {
var frmValid = validateFrmData(dbX,strMode,tblX,currIndx);
if (frmValid == "yes") {
res = invokeConfirmMsg(strMode);
} else {
//skip
}
} else if (strMode == "Delete") {
res = invokeConfirmMsg(strMode);
}


if (res == true) {
    increaseCounter();
    if (strMode == "Append" || strMode == "Edit") {		
	    valZ = validateAppendnEditValues(strMode,dbX,keyCol,tblX,currIndx);
	    if (valZ == "") {
		//alert("No changes to update");
	    }
    } else if (strMode == "Delete") {
        var rsnVal = "";
        rsnVal = document.getElementById(dbX + "Reason").value;
        valZ = rsnVal;        
    } //strMode == Append, Edit else Delete
    if (valZ == "") {
	//skip
    } else {
    	funcAppendAuditRecords(dbX,keyCol,strMode,valZ);
	strVal = "";
    	if (strMode == "Edit" || strMode == "Delete") {
       	    strVal = "lbl" + strMode + currIndx;
           document.getElementById(strVal).innerHTML = "yes";
   
           strVal = "btn" + strMode + currIndx;
           var tempX = document.getElementById(strVal);
           tempX.disabled = true;
           tempX.style.background = "#ddd";
    	} else {
      	   //skip
	}
	closePopupFrm();
    }
} else {
// skip
} // res == true

} // end func

function invokeConfirmMsg(strMode) {

var strMsg = "";
var strVal = "";

  strMsg = "Are you sure you want to ";

  if (strMode == "Delete") {
     strMsg = strMsg + "delete";
  } else if (strMode == "Edit") {
     strMsg = strMsg + "edit";
  } else if (strMode == "Append") {
     strMsg = strMsg + "append";
  }

  strMsg = strMsg + " this record?";

  var res = confirm(strMsg);
  if (res == true) {
    //skip
  } else {    
      strMsg = "";
    
      if (strMode == "Delete") {
         strMsg = "Delete not confirmed";
      } else if (strMode == "Edit") {
         strMsg = "No changes to update";
      } else if (strMode == "Append") {
         strMsg = "No changes to append";
      }
      alert(strMsg);
  }

return res;
} // end func

function validateAppendnEditValues(strMode,dbX,keyCol,tblX,indxVal) {
var valX = "";
var valY = "";
var valZ = "";

var idVal = "";
var colLbl = ""; 
var colName = "";

var rowData = tblX.rows[indxVal].cells;
//alert(rowData[0].childNodes[0].innerHTML);

var hdrX = document.getElementById("hdrID");
//alert(hdrX.childNodes[0].innerHTML);

var colCnt = hdrX.childNodes.length;
//alert(colCnt);
var isValidData = "no";

var tmpStckID = "";
var tmpUrlSrc = "";

valX = "";
var rowX = "";
var colX = "";
var rowIndx = "";
var nodeX = "";
var elmntX = "";

    if (strMode == "Append") {
        //nodeX = document.getElementById("maxID");
        //alert(nodeX.rowIndex);
        rowIndx = (tblX.rows.length-1);
        //rowX = document.createElement("tr");
        rowX = tblX.insertRow(rowIndx);
        rowX.id = dbX + "row" + rowIndx;
    }

    for (var i=0;i<colCnt;i++) {
        //isValidData ="yes";

        colName = "";
        //colName = rowData[i].childNodes[0].id; 
        colName = hdrX.childNodes[i].id;
        //alert(colName);

        tmpStckID = "";
        tmpUrlSrc = "";

        if (colName == 'TrackSrc') {
            var tmpX = document.getElementById(dbX + "trckSrcFile");
            if(tmpX.files.length == 0 ){
                newVal = "NA";
            } else {
                tmpUrlSrc = URL.createObjectURL(tmpX.files[0]);
                //alert(tempUrlSrc);
                tmpTrckID = document.getElementById(dbX + "TrackID").value
                //alert(document.getElementById(dbX + "trckSrcFile").value);
                newVal = document.getElementById(dbX + "trckDestLbl").innerHTML;
            } //tmpX.files.length
        } else {
            newVal = document.getElementById(dbX + colName).value;
        }// if colName == "TrackSrc"

        if (strMode == "Append") {

            colX = document.createElement("td");
            colX.setAttribute("id",dbX + "col" + (i+1));
            //alert(dbX + colName + rowIndx);
            elmntX = document.createElement("label");
            if (colName == 'UserPwd' || colName == 'UserAdmin') {
                elmntX.setAttribute("type","password");
            } else {
                elmntX.setAttribute("type","text");
            }
            elmntX.setAttribute("style","border:none;background:transparent;width:100px;");
            elmntX.setAttribute("readonly","readonly");
            elmntX.id = dbX + colName + rowIndx;
            //elmntX.value = newVal;
            //elmntX.innerHTML = newVal;
            var tagVal = elmntX.tagName.toLowerCase();

            if (colName == 'UserPwd' || colName == 'UserAdmin') {
                var tmpVal1 = newVal;
                var tempVal2 = tmpVal1.replace(/./g, "*");

                if (tagVal == "label") {
                    elmntX.innerHTML = tempVal2;
                } else {
                    elmntX.value = tempVal2;
                }
                //alert(elmntX.value);
            } else {

                if (tagVal == "label") {
                    elmntX.innerHTML = newVal;
                } else {
                    elmntX.value = newVal;
                }

            } // colName userpwd or useradmin

            if (colName == 'TrackDesc' || colName == 'TrackSrc') {
                elmntX.style.display="none";
            }
            colX.appendChild(elmntX);

            if (colName == 'TrackDesc' || colName == 'TrackSrc') {
                elmntX = document.createElement("button");
                elmntX.setAttribute("id", dbX + "btn" + rowIndx);
                if (colName == 'TrackDesc') {
                    elmntX.innerHTML = "Click to read text";
                } else if (colName == 'TrackSrc') {
                    elmntX.innerHTML = "Click to view image";
                }
                elmntX.setAttribute("onclick","funcBindElmntEvent('"+ dbX +"','" + colName +"','" + rowIndx + "')");
                colX.appendChild(elmntX);
            }

            elmntX = document.createElement("label");
            elmntX.setAttribute("id",dbX + colName + rowIndx + "-edit");
            elmntX.setAttribute("style","display:none");
            elmntX.innerHTML = rowData[i].childNodes[1].innerHTML;
            colX.appendChild(elmntX);

            elmntX = document.createElement("label");
            elmntX.setAttribute("id",dbX + colName + rowIndx + "-default");
            elmntX.setAttribute("style","display:none");
            elmntX.innerHTML = rowData[i].childNodes[2].innerHTML;
            colX.appendChild(elmntX);

            rowX.appendChild(colX);

            if (colName == 'TrackSrc') {
                //rowData[i].childNodes[3].value = tmpUrlSrc;
                //alert(tmpUrlSrc);
                elmntX = document.createElement("label");
                elmntX.setAttribute("id",dbX + colName + rowIndx + "-tmp");
                elmntX.setAttribute("style","display:none");
                elmntX.innerHTML = tmpUrlSrc;
                colX.appendChild(elmntX);

                rowX.appendChild(colX);
            }

            if (colName == keyCol) {
                initVal = "keyCol";
            } else {
                initVal = "NA";
            }

            if (newVal == "") {
                newVal = "NA";
            }

            if (valY == "") {
                valY = colName + jsdlmtr + initVal + jsdlmtr + newVal;
            } else {
                valY = valY + "||"+ colName + jsdlmtr + initVal + jsdlmtr + newVal;
            }

        } else if (strMode == "Edit") {

            isEditable = rowData[i].childNodes[1].innerHTML;
            if (isEditable == "enable"){

                var tagVal = rowData[i].childNodes[0].tagName.toLowerCase();
                if (tagVal == "label") {
                    oldVal = rowData[i].childNodes[0].innerHTML;
                } else {
                    oldVal = rowData[i].childNodes[0].value;
                }

                if (colName == "TrackSrc" && newVal == "NA") {
                    //skip
                } else {
                    if (oldVal == newVal) {
                    //skip
                    } else {

                        isValidData ="yes";
                        if (oldVal == "") {
                            oldVal = "NA";
                        }
                        if (newVal == "") {
                            newVal = "NA";
                        }

                        if (valY == "") {
                            valY = colName + jsdlmtr + oldVal + jsdlmtr + newVal;
                        } else {
                            valY = valY + "||"+ colName + jsdlmtr + oldVal + jsdlmtr + newVal;
                        }
                        //alert(jsdlmtr);
                        //alert(valY);

                        var tmpVal = "";
                        if (newVal == "NA") {
                            //alert(newVal);
                            tmpVal = "";
                        } else {
                            tmpVal = newVal
                        }

                        if (tagVal == "label") {
                            rowData[i].childNodes[0].innerHTML = tmpVal;
                        } else {
                            rowData[i].childNodes[0].value = tmpVal;
                        }

                        if (colName == 'TrackSrc') {
                            //alert(tmpUrlSrc);
                            rowData[i].childNodes[3].innerHTML = tmpUrlSrc;
                        }

                        if (colName == 'TrackSrc') {
                            oldVal = "Changed img file";
                            newVal = "Modified img file";
                        } else if (colName == 'TrackDesc') {
                            oldVal = "Changed item desc";
                            newVal = "Modified item desc";
                        } else {
                            //skip
                        }

                        if (valX == "") {
                            valX = colName + jsdlmtr + oldVal + jsdlmtr + newVal;
                        } else {
                            valX = valX + "||"+ colName + jsdlmtr + oldVal + jsdlmtr + newVal;
                        }
                    } // if oldVal == newVal
                }
            } // isEditable == enable
        } // strMode == Append else Edit
    } // for loop

    if (strMode == "Append") {

        elmntX = document.createElement("label");
        elmntX.setAttribute("id",dbX + colName + rowIndx + "-oldval");
        elmntX.setAttribute("style","display:none");
        elmntX.innerHTML = "NA";
        colX.appendChild(elmntX);

        colX = document.createElement("td");
        elmntX = document.createElement("button");
        elmntX.id = "btnEdit" + rowIndx;
        elmntX.disabled = true;
        elmntX.style.background = "#ddd";
        elmntX.innerHTML = "EDIT";
        colX.appendChild(elmntX);
        rowX.appendChild(colX);

        colX = document.createElement("td");
        elmntX = document.createElement("button");
        elmntX.id = "btnDelete" + rowIndx;
        elmntX.disabled = true;
        elmntX.style.background = "#ddd";
        elmntX.innerHTML = "DELETE";
        colX.appendChild(elmntX);
        rowX.appendChild(colX);

        valX = "Appended new record-" + dbX + "-" + keyCol + "-" + document.getElementById(dbX+keyCol).value;
    } else if (strMode == "Edit") {
        //valZ = valX + "~" +valY;
    } // strMode == Append else Edit

    if (valY == "") {
        //skip
    } else {
        valZ = valX + "~" + valY;
    }

    if (dbX == "videotrack") {
        var trckVal = document.getElementById(dbX + "trckDestLbl").innerHTML;
        if (trckVal == "NA") {
            //skip
        } else {

        var lblY = "";

        //alert(keyCol);
        lblY = document.getElementById(dbX + "TrackID");
        var strTrckID = lblY.value;
        //lblY = document.getElementById(dbX+"StckCategory");
        //var strStckCatg = lblY.value;
        lblY = document.getElementById(dbX+"trckSrcLbl");
        var strFromSrc = lblY.innerHTML;
        lblY = document.getElementById(dbX+"trckDestLbl");
        var strDestSrc = lblY.innerHTML;
        var inputX = document.getElementById(dbX+"trckSrcFile");

        //var tempY = document.getElementById("trckDestSrc");
        var tempZ = document.getElementById("trckSrcName");
        var strVal = tempZ.innerHTML;
        maxVal = funcGetMaxVal(strVal,true);
        tempZ.innerHTML = maxVal;
        var strTrckName = tempZ.innerHTML;
        //funcAppendVideoAuditRecords(lblY.value,inputX,lblX.innerHTML,tempX.innerHTML,tempY.innerHTML,tempZ.innerHTML);
        funcAppendVideoAuditRecords(strMode,strTrckName,strTrckID,strFromSrc,strDestSrc,inputX);

        } //imgVal == "NA"
    } //dbX == "videotrack"

//alert(valZ);
return valZ;
} //end func

function funcAppendVideoAuditRecords(strMode,srcName,trckID,trckFromSrc,trckDestSrc,inputX) {
var tblX = document.getElementById("frmTrckAudit");
var rowCnt = tblX.rows.length;

if (rowCnt == 0) {
tblCaption = document.createElement("caption");
tblCaption.innerHTML = "Track Audit";
tblX.appendChild(tblCaption);
} else {
//skip
} // rowCnt
var elmntX = "";
var rowID = (rowCnt+1);
var rowX = document.createElement("tr");

var colX = document.createElement("td");

elmntX = document.createElement("input");
elmntX.setAttribute("id","trckRowID[]");
elmntX.setAttribute("name","trckRowID[]");
elmntX.setAttribute("type","text");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value",rowID);
colX.appendChild(elmntX);
rowX.appendChild(colX);

var colX = document.createElement("td");

elmntX = document.createElement("input");
elmntX.setAttribute("id","trckName[]");
elmntX.setAttribute("name","trckName[]");
elmntX.setAttribute("type","text");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value",srcName);
colX.appendChild(elmntX);

rowX.appendChild(colX);

var colX = document.createElement("td");

elmntX = document.createElement("input");
elmntX.setAttribute("id","trckID[]");
elmntX.setAttribute("name","trckID[]");
elmntX.setAttribute("type","text");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value",trckID);
colX.appendChild(elmntX);

rowX.appendChild(colX);

var colX = document.createElement("td");

elmntX = document.createElement("input");
elmntX.setAttribute("id","trckFromSrc[]");
elmntX.setAttribute("name","trckFromSrc[]");
elmntX.setAttribute("type","text");
elmntX.setAttribute("readonly","readonly");
if (strMode == "Append") {
elmntX.setAttribute("value","NA");
} else {
elmntX.setAttribute("value",trckFromSrc);
}
colX.appendChild(elmntX);

rowX.appendChild(colX);

var colX = document.createElement("td");

elmntX = document.createElement("input");
elmntX.setAttribute("id","trckToSrc[]");
elmntX.setAttribute("name","trckToSrc[]");
elmntX.setAttribute("type","text");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value",trckDestSrc);
colX.appendChild(elmntX);

rowX.appendChild(colX);

var colX = document.createElement("td");

elmntX = document.createElement("input");
elmntX.setAttribute("type","file");
elmntX.setAttribute("id","fileObj[]");
elmntX.setAttribute("name","fileObj[]");
elmntX.files = inputX.files;
//elmntX.files[0] = inputX.files[0];
elmntX.setAttribute("value",inputX.value);
//elmntX.setAttribute("disabled","true");
colX.appendChild(elmntX);
//alert(elmntX);
//alert(elmntX.id);
//alert("file name: " + elmntX.files[0]);
rowX.appendChild(colX);

var colX = document.createElement("td");

elmntX = document.createElement("input");
elmntX.setAttribute("id","trckReason[]");
elmntX.setAttribute("name","trckReason[]");
elmntX.setAttribute("type","text");
elmntX.setAttribute("readonly","readonly");
var tmpVal = "";
if (strMode == "Append") {
tmpVal = "Track ID: " + trckID + " video selected" + " , TranMode : " + strMode;
} else {
tmpVal = "Track ID: " + trckID + " video replaced" + " , TranMode : " + strMode;
}
elmntX.setAttribute("value",tmpVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);
} // end func

function funcAppendAuditRecords(dbX,keyCol,strMode,strUpdate) {

document.getElementById("divFrm").style.display = "block";

var tblX = document.getElementById("frmAudit");
var rowCnt = tblX.rows.length;

if (rowCnt == 0) {
tblCaption = document.createElement("caption");
tblCaption.innerHTML = "Audit";
tblX.appendChild(tblCaption);
} else {
//skip
}

var rowX = document.createElement("tr");

var colX = document.createElement("td");

/*
var maxVal = (rowCnt + 1);
var elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","idVal[]");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value",maxVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);
*/

var maxVal = "";
//alert(document.getElementById("auditMaxVal"));
var tempX = document.getElementById("auditMaxVal");
//alert(tempX.innerHTML);
var strVal = tempX.innerHTML;
maxVal = funcGetMaxVal(strVal,false);
tempX.innerHTML = maxVal;
var elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","idVal[]");
elmntX.setAttribute("readonly","readonly");
elmntX.setAttribute("value",maxVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);

var colX = document.createElement("td");
elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","dbVal[]");
elmntX.setAttribute("readonly","readonly");
//strVal = dbX + jsdlmtr  + "Delete" + jsdlmtr  + "yes";

strVal = dbX + jsdlmtr  + strMode + jsdlmtr  + "yes";
elmntX.setAttribute("value",strVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);

var colX = document.createElement("td");
elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","keyVal[]");
elmntX.setAttribute("readonly","readonly");
strVal = "keyVal" + jsdlmtr  + keyCol + jsdlmtr  + document.getElementById(dbX+keyCol).value;
elmntX.setAttribute("value",strVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);

var colX = document.createElement("td");
elmntX = document.createElement("input");
elmntX.setAttribute("type","text");
elmntX.setAttribute("name","updateVal[]");
elmntX.setAttribute("readonly","readonly");

if (strMode == "Delete") {
strVal = strMode + jsdlmtr + "Reason" + jsdlmtr + strUpdate;
} else if (strMode == "Edit") {
strVal = strUpdate;
} else if (strMode == "Append") {
strVal = strUpdate;
}

elmntX.setAttribute("value",strVal);
colX.appendChild(elmntX);
rowX.appendChild(colX);

tblX.appendChild(rowX);

} //end func

setColor(strColor,"th");
</script>

<!-- The Modal -->
<div id="popupDiv" class="modal">

</div>

</body>
</html>