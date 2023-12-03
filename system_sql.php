<?php
include_once 'connection/common.php';

$pro=isset($_GET["pro"])?$_GET["pro"]:"";
$email=isset($_REQUEST["email"])?$_REQUEST["email"]:"";
$password=isset($_REQUEST["password"])?$_REQUEST["password"]:"";
$token=isset($_REQUEST["token"])?$_REQUEST["token"]:"";

$pass = md5($password);

// $conn->debug=true;

if($pro=='LOGIN'){
	if(str_contains($email,'@student')) {
		$sql = "SELECT * FROM tbluser WHERE is_deleted=0 AND fldactive_ID=1 AND fldusername=".tosql($email);
	} else {
		$sql = "SELECT * FROM tbluser WHERE is_deleted=0 AND fldactive_ID=1 AND fldusername=".tosql($email);
	}
	$rs = $conn->query($sql);
	if($rs->recordcount()>=1){
		$err = 'OK';
	} else {
		$err='XADA';
	}

} else if($pro=='SIGNUP'){
	$sql = "INSER INTO ";
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