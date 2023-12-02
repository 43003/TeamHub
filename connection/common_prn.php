<?php 
date_default_timezone_set("Asia/Kuala_Lumpur"); 
error_reporting (E_ALL ^ E_NOTICE);
require_once('adodb.inc.php');
require_once 'FormatDate.php';

if($pages=='logout'){ 
  $_SESSION['SESS_UID']='';
  @session_destroy();
  $pages='';
}

require_once('setting_db.php');

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
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
      }
      return "'" . $value . "'";
     }
   }
}

function dlookup($Table, $fName, $sWhere)
{
  global $conn;
  $sSQL = "";
  
  $sSQL = "SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere;
  //echo $sSQL;
  $rs2 = $conn->Execute($sSQL);
  if ($rs2) {
    //$_SESSION["s_group"] = $rs2->fields($fName);
    return $rs2->fields($fName);
  }
  else 
    return "";
}
function listLookup($Table, $fName, $sWhere, $sOrder){
  	global $conn; $sSQL='';
	//$conn->debug=true;
	$sSQL = "SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere . " ORDER BY ". $sOrder;
	//print $sSQL;
  	$rs2 = $conn->execute($sSQL);
	if($rs2->recordcount() > 0){  
		return $rs2;
	} else {
		return "";
	}
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

?>
