
function funcGetMaxVal(strVal,blnHypen) {
var maxVal = "";
//alert(strVal);
var numVal = parseInt(strVal.replace(/[^0-9]/g,'')) + 1;
//alert("numeric :" + numVal);
var txtVal1 = strVal.replace(/[^A-Za-z]/g,'');
//alert("char :" + txtVal1);

var txtVal2 = "";

if (numVal >= 0 && numVal <= 9) {
txtVal2 = "0000" + numVal;
} else if (numVal >= 10 && numVal <= 99) {
txtVal2 = "000" + numVal;
} else if (numVal >= 100 && numVal <= 999) {
txtVal2 = "00" + numVal;
} else if (numVal >= 1000 && numVal <= 9999) {
txtVal2 = "0" + numVal;
} else if (numVal >= 10000 && numVal <= 99999) {
txtVal2 = "" + numVal;
}

if (blnHypen == true) {
maxVal = txtVal1 + "-" + txtVal2;
} else {
maxVal = txtVal1 + txtVal2;
}
//alert(maxVal);

return maxVal;
}

function chkNullVal(elmntX) {
var blnNullVal = false;
if (elmntX.value == null || elmntX.value == "") {     
     blnNullVal = true;
} else {
//skip
}
return blnNullVal;
}

function chkValidPassword(elmntX,chkNull) {
var blnValidPwd = true;
  if ((chkNull == true) && (chkNullVal(elmntX) == true)) {
     alert("Password can't be blank!");
     elmntX.focus();
     blnValidPwd = false;
  } else if (elmntX.value.length > 0  && validatePassword(elmntX) == false) {
     alert("3 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter");
     elmntX.focus();
     blnValidPwd = false;
  }
return blnValidPwd;
}

function chkValidName(elmntX,chkNull,maxLen,colName) {
var blnValidName = true;
  if ((chkNull == true) && (chkNullVal(elmntX) == true)) {
     alert(colName + " can't be blank!");
     elmntX.focus();
     blnValidName = false;
  } else if (elmntX.value.length > maxLen ) {
     alert(colName + " can contain only " + maxLen + " characters");
     elmntX.focus();
     blnValidName = false;
  } else if (elmntX.value.length > 0  && validateName(elmntX) == false) {
     alert("Enter only alphabets!");
     elmntX.focus();
     blnValidName = false;
  }
return blnValidName;
}

function chkValidTitle(elmntX,chkNull,maxLen,colName) {
var blnValidTitle = true;
  if ((chkNull == true) && (chkNullVal(elmntX) == true)) {
     alert(colName + " can't be blank!");
     elmntX.focus();
     blnValidTitle = false;
  } else if (elmntX.value.length > maxLen ) {
     alert(colName + " can contain only " + maxLen + " characters");
     elmntX.focus();
     blnValidTitle = false;
  } else if (elmntX.value.length > 0  && validateTitle(elmntX) == false) {
     alert("Enter only alphabets!");
     elmntX.focus();
     blnValidTitle = false;
  }
return blnValidTitle;
}

function chkCharLength(elmntX,maxLen,colName) {
var blnValidTxt = true;
if (elmntX.value.length > maxLen) {
     alert(colName + " should not exceed more than " + maxLen + " characters");
     elmntX.focus();
     blnValidTxt = false;
}
return blnValidTxt;
}

function chkValidEmail(elmntX,chkNull) {
var blnValidEmail = true;
  if ((chkNull == true) && (chkNullVal(elmntX) == true)) {
     alert("Email can't be blank!");
     elmntX.focus();
     blnValidEmail = false;
  } else if (elmntX.value.length > 0  && validateEmail(elmntX) == false) {
     alert("Enter valid email address!");
     elmntX.focus();
     blnValidEmail = false;
  }
return blnValidEmail;
}

function chkValidPhone(elmntX,chkNull) {
var blnValidPhone = true;
  if ((chkNull == true) && (chkNullVal(elmntX) == true)) {
     alert("Phone can't be blank!");
     elmntX.focus();
     blnValidPhone = false;
  } else if (elmntX.value.length > 0  && validatePhoneNo(elmntX) == false) {
     alert("Enter valid phone format!");
     elmntX.focus();
     blnValidPhone = false;
  }
return blnValidPhone;
}

function validatePassword(elmntX) {
//var pattern = (/?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,};
var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{3,14}$/;
   if(elmntX.value.match(pattern))
     {
	return true;
     }
   else
     {
     	return false;
     }
} // end func

function validateTitle(elmntX) {
var regex = /^[0-9a-zA-Z-,]+(\s{0,1}[0-9a-zA-Z-, ])*$/; 
   if(elmntX.value.match(regex))
     {
	return true;
     }
   else
     {
     	return false;
     }
}

function validateName(elmntX) {
var letters = /^[A-Za-z]+$/;
   if(elmntX.value.match(letters))
     {
	return true;
     }
   else
     {
     	return false;
     }
} // end func

function validateEmail(elmntX)
{
var mailformat = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;

//commented /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
if(elmntX.value.match(mailformat))
{
return true;
}
else
{
return false;
}
} // end func

function validatePhoneNo(elmntX)
{
  //var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
  var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9])+$/;

  if(elmntX.value.match(phoneno))
  {
     return true;
  }
  else
  {
     return false;
  }
} // end func
