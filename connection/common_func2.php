<?php 
// $css_pop = '../../css/general.css';
// $css_pop1 = '../css/general.css';
// $css_cetak = '../include/printsurat.css';

if(isset($_SESSION['SESS_levelID'])){ $levelid = $_SESSION["SESS_levelID"]; }
if(isset($_SESSION['SESS_fldpenerima'])){ $pegawai_terima = $_SESSION["SESS_fldpenerima"]; }
if(isset($_SESSION['SESS_fldpenaksircaj'])){ $pegawai_caj = $_SESSION["SESS_fldpenaksircaj"]; }
if(isset($_SESSION['SESS_fldpemeriksa'])){ $pegawai_periksa = $_SESSION["SESS_fldpemeriksa"]; }
if(isset($_SESSION['SESS_fldpemantau'])){ $pegawai_pantau = $_SESSION["SESS_fldpemantau"]; }
if(isset($_SESSION['SESS_fldpengesah'])){ $pegawai_sah = $_SESSION["SESS_fldpengesah"]; }
if(isset($_SESSION['SESS_fldcetak'])){ $pegawai_cetak = $_SESSION["SESS_fldcetak"]; }
if(isset($_SESSION['SESS_fldfasttrack'])){ $pegawai_fasttrack = $_SESSION["SESS_fldfasttrack"]; }

if(isset($_SESSION['SESS_levelID'])){ $levelid = $_SESSION["SESS_levelID"]; }
if(isset($_SESSION['SESS_jakim_state'])){ $jakim_state = $_SESSION["SESS_jakim_state"]; }
if(isset($_SESSION['SESS_comp_reg'])){ $mycoid = $_SESSION["SESS_comp_reg"]; }
if(isset($_SESSION['SESS_compcode'])){ $compcode = $_SESSION["SESS_compcode"]; }
$user_id=$_SESSION["SESS_UID"];


function encode5t($str){
	for($i=0; $i<5;$i++){
		$str=strrev(base64_encode($str)); //apply base64 first and then reverse the string
	}
	return $str;
}

//function to decrypt the string
function decode5t($str){
	for($i=0; $i<5;$i++){
		$str=base64_decode(strrev($str)); //apply base64 first and then reverse the string}
	}
	return $str;
}

//session_start();
function tohtml($strValue)
{
	//$str = preg_replace("/\\r\\n|\\r|\\n/",'<br/>',$strValue);
	$str = str_replace(array("\\r\\n","\\r","\\n","\r\n","\r","\n"), "<br>",$strValue);
	//$str = str_replace("\r\n","<br>",$strValue);
	//print $strValue;
  	//return htmlspecialchars($str);
  	return $str;
}

function totextarea($content){
	$str = str_replace(array("\\r\\n","\\r","\\n","\r\n","\r"), "\n",$content);
	return $str;
}

function tourl($strValue)
{
  return urlencode($strValue);
}

function get_param($ParamName)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;

  $ParamValue = "";
  if(isset($HTTP_POST_VARS[$ParamName]))
    $ParamValue = $HTTP_POST_VARS[$ParamName];
  else if(isset($HTTP_GET_VARS[$ParamName]))
    $ParamValue = $HTTP_GET_VARS[$ParamName];

  return $ParamValue;
}

function get_session($ParamName)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;
  global ${$ParamName};
  $ParamValue = "";
  if(!isset($HTTP_POST_VARS[$ParamName]) && !isset($HTTP_GET_VARS[$ParamName]) && session_is_registered($ParamName))
     $ParamValue = ${$ParamName};
  return $ParamValue;
}

function set_session($ParamName, $ParamValue)
{
  global ${$ParamName};
  if(session_is_registered($ParamName)) 
    session_unregister($ParamName);
  ${$ParamName} = $ParamValue;
  session_register($ParamName);
}

function is_number($string_value)
{
  if(is_numeric($string_value) || !strlen($string_value))
    return true;
  else 
    return false;
}

function is_param($param_value)
{
  if($param_value)
    return 1;
  else
    return 0;
}

function tosql($value, $type="Text")
{
  if($value == "")
  {
    return "NULL";
  }
  else
  {
    if($type == "Number")
      return doubleval($value);
    else
    {
      if(get_magic_quotes_gpc() == 0)
      {
        //$value = str_replace("'","''",$value);
        //$value = str_replace("\\","\\\\",$value);
        $value = str_replace("'","\'",$value);
        $value = str_replace('"','\"',$value);
        //$value = str_replace("\\","\\'",$value);
      }
      else
      {
        //$value = str_replace("\\'","''",$value);
        //$value = str_replace("\\\"","\"",$value);
        $value = str_replace("\\'","\'",$value);
        $value = str_replace('\\"','\"',$value);
        //$value = str_replace("\\\"","\"",$value);
      }
	  
	  	$val = "'" . $value . "'";
    	//if($val=="'\'"){ $val="''"; }
	  	return $val;
	  
	  	//return "'" . addslashes($value) . "'";
     }
   }
}

function strip($value)
{
  if(get_magic_quotes_gpc() == 0)
    return $value;
  else
    return stripslashes($value);
}

function get_checkbox_value($sVal, $CheckedValue, $UnCheckedValue)
{
  if(!strlen($sVal))
    return tosql($UnCheckedValue);
  else
    return tosql($CheckedValue);
}

function dlookup($Table, $fName, $sWhere)
{
  global $conn;
  $sSQL = "";
  
  $sSQL = "SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere;
  //echo $sSQL;
  $rs2 = $conn->query($sSQL);
  if ($rs2) {
    //$_SESSION["s_group"] = $rs2->fields($fName);
    return $rs2->fields($fName);
  }
  else 
    return "";
}

function dlookup_cnt($Table, $fName, $sWhere)
{
  global $conn;
  $sSQL = "";
  
  $sSQL = "SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere;
  //echo $sSQL;
  $rs2 = $conn->query($sSQL);
  return $rs2->recordcount();
}

function dlookupid($Table, $fName, $id, $sWhere)
{
  global $conn;
  $sSQL = "";
  
  $sSQL = "SELECT " . $fName . " FROM " . $Table . " WHERE " . $id ."=" . $sWhere;
  //echo $sSQL;
  $rs2 = $conn->query($sSQL);
  if ($rs2) {
    $_SESSION["s_group"] = $rs2->fields($fName);
    return $rs2->fields($fName);
  }
  else 
    return "";
}

function dlookup2($Table, $fName1, $fName2, $sWhere)
{
  global $conn;
  $sSQL = "";
  
  $sSQL = "SELECT " . $fName1 . ", " . $fName2 . " FROM " . $Table . " WHERE " . $sWhere;
  //echo $sSQL;
  $rs2 = $conn->query($sSQL);
  if ($rs2) {
	  $data = $rs2->fields($fName1).": ".$rs2->fields($fName2) ;
   	  return $data;
  }
  else 
    return "";
}

function dlookup_state($jakim_state)
{
  global $conn;
  $sSQL = "";
  
  $sSQL = "SELECT * FROM ref_state WHERE fldstateID=" . tosql($jakim_state);
  //echo $sSQL;
  $rs2 = $conn->query($sSQL);
  if (!$rs2->EOF) {
	  $data = $rs2->fields['fldstatedesc'];
   	  return $data;
  }
  else 
    return "Jakim";
}

function audit_trail($log, $proses){
	global $conn; 
	$sSQL = "";
	//$id_user = $_SESSION["SESS_UID"];
	$users = $_SESSION["SESS_UID"];
	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date("Y-m-d H:i:s");
	if(!empty($users)){
	$sSQL = "INSERT INTO _view_tblaudit(userid, log, proses, log_date, ip) 
	VALUES(".tosql($users).", ".tosql($log).", ".tosql($proses).", ".tosql($time).", ".tosql($ip).")";
	$conn->Execute($sSQL);
	} else {
		print "User empty";
	}
}

function audit_trail_log($log, $proses, $user_id){
	global $conn; 
	$sSQL = "";
	//$id_user = $_SESSION["SESS_UID"];
	//$users = $user_id; //$_SESSION["SESS_UID"];
	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date("Y-m-d H:i:s");

	$sSQL = "INSERT INTO _view_tblaudit(userid, log, proses, log_date, ip) 
	VALUES(".tosql($user_id).", ".tosql($log).", ".tosql($proses).", ".tosql($time).", ".tosql($ip).")";
	$conn->Execute($sSQL);
}

function audit_log($tran, $users, $pro){
	global $conn;
	$sSQL = "";
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if($pro=='ERR'){ $trans='ERROR Login Sistem ('.$tran.")"; } else { $trans = 'Login Sistem'; }
	$time = date("Y-m-d H:i:s");
	//$conn->debug=true;
	//$rs = $conn->query("SELECT * FROM auditlog WHERE log_user=".tosql($user)." AND trans_date=".tosql($time));
	$rs = $conn->query("SELECT * FROM auditrail WHERE username=".tosql($user)." AND created=".tosql($time));
	if($rs->EOF){
		$sSQLLog = "INSERT INTO auditrail(created, `desc`, action, username, ip) 
		VALUES(".tosql($time).", ".tosql($trans).", 'login', ".tosql($users).", ".tosql($ip).")";
		$conn->Execute($sSQLLog);
	}
	//print $sSQLLog; exit;
}

function set_pg($Page)
{
  $Page = 30;
  global ${$Page};
}

function get_pg()
{
  $Page = 30;
  global ${$Page};
  return;
}


//-------------------------------
// Verify user's security level and redirect to login page if needed
//-------------------------------

function check_security($security_level)
{
  global $UserRights;
  if(!session_is_registered("UserID"))
  {
    header ("Location: default.php?querystring=" . urlencode(getenv("QUERY_STRING")) . "&ret_page=" . urlencode(getenv("REQUEST_URI")));
    exit;
  }
//  else
//    if(get_session("UserRights") != "00")
//    {
//      header ("Location: default.php?querystring=" . urlencode(getenv("QUERY_STRING")) . "&ret_page=" . urlencode(getenv("REQUEST_URI")));
//      exit;
//    }
}

function now()
{
  return date("Y-m-d G:i:s");
}

function vdate($ldate)
{
  $ldate = str_replace(":","-",$ldate);
  $ldate = str_replace(" ","-",$ldate);
  list ($year, $month, $day, $hour, $minute) = explode("-", $ldate);
  if ($newdate = mktime ($hour, $minute, 0, $month, $day, $year)) {
    if (@date("H-i", $newdate) == "00-00")
      return @date("m/d/y", $newdate);
    else
      return @date("m/d/y h:i A", $newdate);
  }
}

function sdate($ldate)
{
  list ($year, $month, $day, $hour, $minute) = explode("-", $ldate);
  $newdate = mktime (0, 0, 0, $month, $day, $year);
  return date("m/d/Y", $newdate);
}
function yy($ldate)
{
  list ($day, $month, $year, $hour, $minute) = explode("-", $ldate);
  $newdate = mktime (0, 0, 0, $month, $day, $year);
  return date("Y", $newdate);
}
function ndate($ldate)
{
  list ($day, $month, $year, $hour, $minute) = explode("-", $ldate);
  $newdate = mktime (0, 0, 0, $month, $day, $year);
//  return date("Y-m-d", $newdate);
  return $year . "-" . $month . "-" . $day;
}
function mdate($ldate)
{
  list ($year, $month, $day, $hour, $minute) = explode("-", $ldate);
  $newdate = mktime(0, 0, 0, $month, $day, $year);
//  return date("d-m-Y", $newdate);
  return $day . "-" . $month . "-" . $year;
}
function datetodb($edate)
{
  return date("Y-m-d H:i:s",strtotime($edate));
}

function sendemails($email_sql, $email_from, $email_subject, $email_body)
{
    $db = new DB_Sql();
    $db->Database = DATABASE_NAME;
    $db->User     = DATABASE_USER;
    $db->Password = DATABASE_PASSWORD;
    $db->Host     = DATABASE_HOST;

    $db->query($email_sql);
    while($db->next_record())
      mail($db->f(0), $email_subject, $email_body,"From: $email_from");
}

function sendemail($email_to, $email_from, $email_subject, $email_body)
{
    mail($email_to, $email_subject, $email_body,"From: $email_from");
}

//echo $sUpd . "<br>";

// YEAR END
$year_lahir="1940";
$year_select="1980";
$year_end = "2040";
//   GlobalFuncs end
//===============================

function set_hari($ha){
	if($ha==1){ $h = "Ahad"; }
	else if($ha==2){ $h = "Isnin"; }
	else if($ha==3){ $h = "Selasa"; }
	else if($ha==4){ $h = "Rabu"; }
	else if($ha==5){ $h = "Khamis"; }
	else if($ha==6){ $h = "Jumaat"; }
	else if($ha==7){ $h = "Sabtu"; }
	
	return $h;
}

function listLookup($Table, $fName, $sWhere, $sOrder){
  	global $conn; $sSQL='';
	//$conn->debug=true;
	$sSQL = "SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere . " ORDER BY ". $sOrder;
	//print $sSQL;
  	$rs2 = $conn->query($sSQL);
	if($rs2->recordcount() > 0){  
		return $rs2;
	} else {
		return "";
	}
}

/**
 *
 * @param string $dt            // MySQL formatted date (like 2010-01-01)
 * @param int $year_offset        // like 2 or -2, or 5 or -5 ...
 * @param int $month_offset    // like 2 or -2, or 5 or -5 ...
 * @param in $day_offset        // like 2 or -2, or 5 or -5 ...    
 * @return string             // the new MySQL formatted date (like 2009-07-01)
 */

function MySQLDateOffset($dt,$year_offset='',$month_offset='',$day_offset=''){
      return ($dt=='0000-00-00') ? '' : date ("Y-m-d", mktime(0,0,0,substr($dt,5,2)+$month_offset,substr($dt,8,2)+$day_offset,substr($dt,0,4)+$year_offset));
} 

function get_kategori($kod){
  global $conn;
  $sSQL = "";
  
  $sSQL = "SELECT * FROM ref_kategori_mohon WHERE kat_kod=" . tosql($kod);
  $rs2 = $conn->query($sSQL);
  if ($rs2){ return $rs2->fields['kat_nama'].":".$rs2->fields['kat_namafail'].":".$rs2->fields['kat_namaprint']; }
  else { return ""; }
}

function user_semak($mohon_id, $type){
	global $conn;
	$sSQL = "";
	$user_id=$_SESSION['SESS_UID'];
	if($user_id<>'2'){
		$user_name=$_SESSION['SESS_username'];
		$dt = date("Y-m-d H:i:s");
		$s = "SELECT * FROM _sis_tblpermohonan_semak WHERE fldmohon_id=".tosql($mohon_id)." AND flduser_id=".tosql($user_id)." AND fldsemak_type=".tosql($type);
		$rsus = $conn->query($s);
		if($rsus->EOF){
			$sSQL = "INSERT INTO _sis_tblpermohonan_semak (fldmohon_id, flduser_id, flduser_name, fldsemak_type, create_dt, update_dt)
				VALUES(".tosql($mohon_id).", ".tosql($user_id).", ".tosql($user_name).", ".tosql($type).", ".tosql($dt).", ".tosql($dt).")";
		} else {
			$sSQL = "UPDATE _sis_tblpermohonan_semak SET update_dt=".tosql($dt)." WHERE fldsemak_id=".tosql($rsus->fields['fldsemak_id']);
		}
		$rs2 = $conn->Execute($sSQL);
	}
}

function user_semak_log($mohon_id, $type, $user_id){
	//print "SEMAK";
	global $conn;
	$sSQL = "";
	//$user_id=$_SESSION['SESS_UID'];
	if($user_id<>'2'){
		$user_name=$user_id; //$_SESSION['SESS_username'];
		$dt = date("Y-m-d H:i:s");
		$s = "SELECT * FROM _sis_tblpermohonan_semak WHERE fldmohon_id=".tosql($mohon_id)." AND flduser_id=".tosql($user_id)." AND fldsemak_type=".tosql($type);
		$rsus = $conn->query($s);
		if($rsus->EOF){
			$sSQL = "INSERT INTO _sis_tblpermohonan_semak (fldmohon_id, flduser_id, flduser_name, fldsemak_type, create_dt, update_dt)
				VALUES(".tosql($mohon_id).", ".tosql($user_id).", ".tosql($user_name).", ".tosql($type).", ".tosql($dt).", ".tosql($dt).")";
		} else {
			$sSQL = "UPDATE _sis_tblpermohonan_semak SET update_dt=".tosql($dt)." WHERE fldsemak_id=".tosql($rsus->fields['fldsemak_id']);
		}
		$rs2 = $conn->Execute($sSQL);
	}
}

function user_semak_view($mohon_id, $type){
	global $conn;
	$sSQL = "";
	//$conn->debug=true;
	$s = "SELECT * FROM _sis_tblpermohonan_semak WHERE fldmohon_id=".tosql($mohon_id)." AND fldsemak_type=".tosql($type);
	$rsus = $conn->query($s);
	$bil=0; $dat='';
	while(!$rsus->EOF){
		if($bil==0){ $dat = "- ".$rsus->fields['flduser_name']. " &nbsp;<i>[".$rsus->fields['update_dt']."]</i>"; }
		else { $dat .= "<br>- ".$rsus->fields['flduser_name']. " &nbsp;<i>[".$rsus->fields['update_dt']."]</i>"; }
		$bil++;
		$rsus->movenext();
	}
	$conn->debug=false;
	return $dat; 
}

function user_semak_list($mohon_id, $status){
	global $conn;
	$sSQL = "";
	if($status=='1'){ $type='TERIMA'; }
	else if($status=='2'){ $type='TERIMA_SAH'; }
	else if($status=='3'){ $type='TERIMA_SAH'; }
	else if($status=='4'){ $type='SEMAK'; }
	else if($status=='4'){ $type='SEMAK'; }
	else if($status=='5'){ $type='CAJ'; }
	//else if($status=='5'){ $type='CAJ1'; }
	else if($status=='6'){ $type='CAJ1'; }
	else if($status=='7'){ $type='AUDIT'; }
	else if($status=='8'){ $type='PANEL'; }
	else if($status=='9'){ $type='SAH'; }
	//$conn->debug=true;
	if(!empty($type)){
		$s = "SELECT * FROM _sis_tblpermohonan_semak WHERE fldmohon_id=".tosql($mohon_id); //." AND fldsemak_type LIKE '".$type."%'";
		$s .= " ORDER BY update_dt DESC";
		$rsus = $conn->query($s);
		$bil=0; $dat='';
		while(!$rsus->EOF){
			$dat = "<br><i>- ".$rsus->fields['flduser_name']. " </i>";
			$dat .= " &nbsp;<img src=\"images/jshelp.gif\" onclick=\"open_modal('admin/view_pegawai_proses.php?id=$mohon_id&stat=$status','Senarai Pegawai Proses','70','70')\" style=\"cursor:pointer\" title=\"Sila klik bagi paparan senarai pegawai\"> ";
			$rsus->movenext();
		}
	}
	$conn->debug=false;
	return $dat; 
}

function view_semak_list($mohon_id){
	global $conn;
	$s = "SELECT * FROM _sis_tblpermohonan_semak WHERE fldmohon_id=".tosql($mohon_id)." ORDER BY update_dt DESC";
	$rsus = $conn->query($s);
	$dat = "<br><i>".$rsus->fields['flduser_name'].'</i>';
	$dat .= " &nbsp;<img src=\"images/jshelp.gif\" onclick=\"open_modal('admin/view_pegawai_proses.php?id=$mohon_id&stat=$status','Senarai Pegawai Proses','70','70')\" style=\"cursor:pointer\" title=\"Sila klik bagi paparan senarai pegawai\"> ";
	return $dat;
}


function user_semak_premis($mohon_id, $periksa_id, $type){
	global $conn;
	$sSQL = "";
	$user_id=$_SESSION['SESS_UID'];
	if($user_id<>'2'){
		$user_name=$_SESSION['SESS_username'];
		$dt = date("Y-m-d H:i:s");
		$s = "SELECT * FROM _sis_tblpermohonan_semak WHERE fldperiksa_id=".tosql($periksa_id)." 
			AND flduser_id=".tosql($user_id)." AND fldsemak_type=".tosql($type);
		$rsus = $conn->query($s);
		if($rsus->EOF){
			$sSQL = "INSERT INTO _sis_tblpermohonan_semak (fldmohon_id, fldperiksa_id, flduser_id, flduser_name, fldsemak_type, create_dt, update_dt)
				VALUES(".tosql($mohon_id).", ".tosql($periksa_id).", ".tosql($user_id).", ".tosql($user_name).", 
				".tosql($type).", ".tosql($dt).", ".tosql($dt).")";
		} else {
			$sSQL = "UPDATE _sis_tblpermohonan_semak SET update_dt=".tosql($dt)." WHERE fldsemak_id=".tosql($rsus->fields['fldsemak_id']);
		}
		$rs2 = $conn->Execute($sSQL);
	}
}

function user_semak_view_periksa($mohon_id, $periksa_id, $type){
	global $conn;
	$sSQL = "";
	//$conn->debug=true;
	$s = "SELECT * FROM _sis_tblpermohonan_semak WHERE fldmohon_id=".tosql($mohon_id)." 
		AND fldperiksa_id=".tosql($periksa_id)." AND fldsemak_type=".tosql($type);
	$rsus = $conn->query($s);
	$bil=0; $dat='';
	while(!$rsus->EOF){
		if($bil==0){ $dat = "- ".$rsus->fields['flduser_name']. " &nbsp;<i>[".$rsus->fields['update_dt']."]</i>"; }
		else { $dat .= "<br>- ".$rsus->fields['flduser_name']. " &nbsp;<i>[".$rsus->fields['update_dt']."]</i>"; }
		$bil++;
		$rsus->movenext();
	}
	$conn->debug=false;
	return $dat; 
}

function cleanHTML($html) {
	/// <summary>
	/// Removes all FONT and SPAN tags, and all Class and Style attributes.
	/// Designed to get rid of non-standard Microsoft Word HTML tags.
	/// </summary>
	// start by completely removing all unwanted tags
	
	$html = ereg_replace("<(/)?(font|span|del|ins)[^>]*>","",$html);
	
	// then run another pass over the html (twice), removing unwanted attributes
	$html = ereg_replace("<([^>]*)(class|lang|style|size|face)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>","<\\1>",$html);
	$html = ereg_replace("<([^>]*)(class|lang|style|size|face)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>","<\\1>",$html);
	// sample word html <p class="aaa" style="background:dot">abc</p> will return <p > </p>
	return $html;
}

function remove_tags($values){
	
	$values  = str_ireplace("<b>","",$values);
	$values  = str_ireplace("</b>","",$values);
	$values  = str_ireplace("<i>","",$values);
	$values  = str_ireplace("</i>","",$values);
	//$values  = str_ireplace("<br>","",$values);
	return $values;
}

function countdown ($dateto,$ty){
    $tstampfrom = strtotime(date("Y-m-d 00:00:00"));
    $tstampto = strtotime($dateto);
	//if($ty=='H'){ $datediff = $tstampto - $tstampfrom; }
	if($ty=='H'){ $datediff = $tstampto - $tstampfrom; }
	else if($ty=='T') { $datediff = $tstampfrom - $tstampto; }
	else { $datediff = $tstampto - $tstampfrom; }
    $daysdiff = $datediff / 86400;
    //if (round($daysdiff,0) > $daysdiff){
        //$numdays = $daysdiff;
		
		//print $tstampto."-".$tstampfrom."/"."[".$datediff."]".$daysdiff;
        
		if($daysdiff<29) { $numdays = "<1"; }
        else if($daysdiff>=30 && $daysdiff<=50) { $numdays = 1; }
        else if($daysdiff>=51 && $daysdiff<=80) { $numdays = 2; }
        else if($daysdiff>=81 && $daysdiff<=110) { $numdays = 3; }
        else if($daysdiff>=111 && $daysdiff<=140) { $numdays = 4; }
        else if($daysdiff>=141 && $daysdiff<=170) { $numdays = 5; }
        else if($daysdiff>=171 && $daysdiff<=200) { $numdays = 6; }
        else if($daysdiff>=201 && $daysdiff<=230) { $numdays = 7; }
        else if($daysdiff>=231 && $daysdiff<=260) { $numdays = 8; }
        else if($daysdiff>=261 && $daysdiff<=290) { $numdays = 9; }
        else if($daysdiff>=291 && $daysdiff<=320) { $numdays = 10; }
        else if($daysdiff>=321 && $daysdiff<=350) { $numdays = 11; }
        else if($daysdiff>=351) { $numdays = 12; }
        //else
        //if
        //return $daysdiff."(".$numdays.")". $ty;
        return $numdays;
}

function get_user($uid){
	global $conn;
	$sql = "SELECT fldfullname FROM tbluser WHERE flduser_ID=".tosql($uid);
	$rsu = $conn->query($sql);
	return $rsu->fields['fldfullname'];
}

function format_addres($add1, $add2, $add3, $bandar, $poskod, $daerah, $negeri){
	$is_dae=0;	
	if(!empty($add1)){ $alamat .= stripslashes($add1); }
	if(!empty($add2)){ $alamat .= "<br>".stripslashes($add2); }
	if(!empty($add3)){ $alamat .= "<br>".stripslashes($add3); }
	if(!empty($bandar)){ $alamat .= "<br>".$bandar; }
	if(!empty($poskod)){ $alamat .= "<br>".$poskod; }
	if(!empty($daerah)){ 
		$dae = strtoupper(trim($daerah)); 
		if($dae=='TIADA MAKLUMAT DAERAH'){ $daes=''; }
		else if($dae=='TIADA MAKLUMAT'){ $daes=''; }
		else { $daes=$dae; }
		if(!empty($daes)){ $alamat .= "<br>".$daes.", "; $is_dae=1; }
	}
	if(!empty($negeri)){ 
		if(empty($is_dae)){ $alamat .= "<br>".$negeri; }
		else {  $alamat .= ", ".$negeri; }
	}

	return $alamat;
}


function check_forbidden($forbiddennames, $stringtocheck) 
{
    foreach ($forbiddennames as $name) {
        //if (stripos($stringtocheck, $name)) {
		$names = "~\b".$name."\b~";	
        if(preg_match($names,$stringtocheck)){
		    return true;
        }
    }
}

$forbiddennames= array(1 => "babi","hot dog","hotdog","anjing","ham","bak kut teh","beacon","beer","rum","charsiew","pork");    

?>





<script language="javascript" type="text/javascript">
function do_submit(fileName){
        document.eHalal.action = fileName;
        document.eHalal.target = 'mainFrame';
        document.eHalal.submit();
}

function do_hapus(fileName){
        //alert(ids);
        if (confirm("<?php print $permohonan_list_delete;?>")) {
                //alert("hai")
                document.eHalal.action = fileName;
                document.eHalal.target = 'mainFrame';
                document.eHalal.submit();
                //return true;
        } else {
                close();
        }
}

function do_print(URL){
        document.eHalal.action = URL;
        document.eHalal.target='_blank';
        document.eHalal.submit();
}

function do_btn(URL){
        //alert(URL);
        document.eHalal.action = URL;
        document.eHalal.submit();
}


function SemakNamaProduk(string) {
	var index;
	var word = ["babi","hot dog" ,"hotdog","anjing","ham","bak kut teh","beacon","beer","rum","charsiew","pork"];
    var val ='';
	var text = string.toLowerCase(); 
	//text = text.trim();
	for (index = 0; index < word.length; ++index) {
		//val = new RegExp('(?:[^.\w]|^|^\\W+)' + word[index] + '(?:[^.\w]|\\W(?=\\W+|$)|$)').test(text);
		val = new RegExp('\\b' + word[index] + '\\b').test(text);
		if(val==true){ 
			alert("Sila pastikan maklumat nama porduk anda tidak mengandungi sebarang perkataan seperti:\n"+
				"babi, hot dog, hum, bak kut teh, bacon, beer, rum, hotdog, charsiew.");
			return val; 
		}
	}
}

//var myRegExp = /dog/;
//var myText = " My dog smells worse than your dog";
//if(myRegExp.test(myText))
// app.alert("Found a dog!",2)

function SemakJenama(string) {
	var index;
	var word = ["babi","hot dog" ,"hotdog","anjing","ham","bak kut teh","beacon","beer","rum","charsiew","pork"];
    var val ='';
	var text = string.toLowerCase(); 
	for (index = 0; index < word.length; ++index) {
		//val = new RegExp('(?:[^.\w]|^|^\\W+)' + word[index] + '(?:[^.\w]|\\W(?=\\W+|$)|$)').test(text);
		val = new RegExp('\\b' + word[index] + '\\b').test(text);
		if(val==true){ 
			alert("Sila pastikan maklumat nama jenama anda tidak mengandungi sebarang perkataan seperti:\n"+
				"babi, hot dog, hum, bak kut teh, bacon, beer, rum, hotdog, charsiew.");
			return val; 
		}
	}
}


</script>