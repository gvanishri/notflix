
//frmAdminFrame

var prfElmntDef = "";
var prfAttrDef = "";

var currUsrRS = "";
var urlPath = "";
var imgSrc = "";
urlPath = sessionStorage.siteDomainName;

var prfPageAttr = "prfAcct|Profile|Manage your profile";
prfPageAttr = prfPageAttr + "||" + "prfChgPwd|Profile|Change password";

prfElmntDef = "tblProfile|prfrw1|tr";
prfElmntDef = prfElmntDef + "||" + "tblProfile|prfrw2|tr";

prfElmntDef = prfElmntDef + "||" + "prfrw1|prfrw1cl1|td";
prfElmntDef = prfElmntDef + "||" + "prfrw1|prfrw1cl2|td";
prfElmntDef = prfElmntDef + "||" + "prfrw1|prfrw1cl3|td";
prfElmntDef = prfElmntDef + "||" + "prfrw1|prfrw1cl4|td";
prfElmntDef = prfElmntDef + "||" + "prfrw1|prfrw1cl5|td";

prfElmntDef = prfElmntDef + "||" + "prfrw1cl2|prfCntr|center";
prfElmntDef = prfElmntDef + "||" + "prfCntr|prfPara|p";

prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfLblUsr|label";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfSep01|br";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfLblUsrID|label";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfSep02|br";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfImg|img";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfLblEdit|label";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfSep03|br";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl3|prfLblUsrPwd|label";

prfElmntDef = prfElmntDef + "||" + "prfrw1cl4|prfH3|h3";
prfElmntDef = prfElmntDef + "||" + "prfrw1cl4|prfHdrLbl|label";

prfElmntDef = prfElmntDef + "||" + "prfrw1cl5|prfBtn|button";

prfElmntDef = prfElmntDef + "||" + "prfrw2|prfrw2cl1|td";

prfElmntDef = prfElmntDef + "||" + "prfrw2cl1|div1|div";


prfAttrDef = "";

prfAttrDef = "tblProfile|style|width:100%;margin:10px;";
prfAttrDef = prfAttrDef + "||" + "prfrw1|style|height:100px;";
prfAttrDef = prfAttrDef + "||" + "prfrw2|style|height:80px;background-color:tranparent";

prfAttrDef = prfAttrDef + "||" + "prfrw1cl1|style|width:4%;background:transparent;";
prfAttrDef = prfAttrDef + "||" + "prfrw1cl2|style|width:6%;background:transparent;";

prfAttrDef = prfAttrDef + "||" + "prfrw1cl3|style|width:15%;background:transparent;text-align:left;";

prfAttrDef = prfAttrDef + "||" + "prfrw1cl4|style|width:70%;padding:10px;text-align:left;";
prfAttrDef = prfAttrDef + "||" + "prfrw1cl5|style|width:5%;padding:10px;text-align:left;";

prfAttrDef = prfAttrDef + "||" + "prfrw2cl1|style|width:100%;padding:10px;text-align:center;";
prfAttrDef = prfAttrDef + "||" + "prfrw2cl1|colspan|5";

//prfAttrDef = prfAttrDef + "||" + "div1|style|width:100%;text-align:center;margin-left:auto;margin-right:auto;";

prfAttrDef = prfAttrDef + "||" + "prfPara|class|circle";
prfAttrDef = prfAttrDef + "||" + "prfLblUsrID|style|display:none;";
prfAttrDef = prfAttrDef + "||" + "prfLblUsrPwd|style|display:none;";

prfAttrDef = prfAttrDef + "||" + "prfImg|style|width:20px;height:15px;vertical-align:middle;";

imgSrc = urlPath + "image-icn/editImg.jpg";

prfAttrDef = prfAttrDef + "||" + "prfImg|src|" +imgSrc;
prfAttrDef = prfAttrDef + "||" + "prfImg|alt|profileImg";
prfAttrDef = prfAttrDef + "||" + "prfLblEdit|innerHTML|Edit Profile";

//prfAttrDef = prfAttrDef + "||" + "prfH3|innerHTML|Test";
//prfAttrDef = prfAttrDef + "||" + "prfHdrLbl|innerHTML|Test Profile";

prfAttrDef = prfAttrDef + "||" + "prfBtn|onclick|onLogoutClick()";
prfAttrDef = prfAttrDef + "||" + "prfBtn|innerHTML|Logout";
