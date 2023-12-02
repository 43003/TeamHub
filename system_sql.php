<?php
include_once '../connection/common.php';
hello
$pro=isset($_GET["pro"])?$_GET["pro"]:"";
$pengguna=isset($_REQUEST["pengguna"])?$_REQUEST["pengguna"]:"";
//$Passwd=isset($_REQUEST["katalaluan"])?$_REQUEST["katalaluan"]:"";
$katamasuk=isset($_REQUEST["katamasuk"])?$_REQUEST["katamasuk"]:"";
$token=isset($_REQUEST["token"])?$_REQUEST["token"]:"";
//$_SESSION['SESS_LOG']="LOG";
//$pwd = encode5t($Passwd);
//session_start();	
//$pengguna='1234567890';
//$katamasuk='1234567890';
$pass = md5($katamasuk);
//$pwd = $katamasuk;
$tarikh = date("Y-m-d H:i:s");
//print $pengguna." / ".$pro;

//$sql = "SELECT * FROM _tbl_users WHERE isdeleted=0 AND username=".tosql($UserID)." AND passwords=".tosql($pwd);
//if($_SESSION['token']==$token){

// $conn->debug=true;

if($pro=='SAVE'){
	$sql = "SELECT * FROM tbluser WHERE is_deleted=0 AND fldactive_ID=1 AND fldusername=".tosql($pengguna);
	$rs = $conn->query($sql);
	if($rs->recordcount()>=1){
		$err = 'OK';
	} else {
		$err='XADA';
	}

}

header("Content-Type: text/json");
print json_encode($err); 
?>