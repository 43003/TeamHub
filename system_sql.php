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
		$sql = "SELECT * FROM student WHERE  AND email=".tosql($email);
	} else {
		$sql = "SELECT * FROM lecturer WHERE email=".tosql($email);
	}
	$rs = $conn->query($sql);
	if($rs->recordcount()>=1){
		if(!$rs->EOF){
			//$err = 'OK';
			@session_start();
			$user_katamasuk = $rs->fields['fldpassword'];
			
			if($user_katamasuk == $pass){
				$_SESSION['SESS_UID']=$rs->fields['flduser_ID'];
				$_SESSION['SESS_UIC']=$rs->fields['fldusername'];
				$_SESSION['SESS_ULOG']=$rs->fields['fldusername'];
				$_SESSION['SESS_UNAME']=$rs->fields['fldfullname'];
				$_SESSION['SESS_EMEL']=$rs->fields['fldemail'];
				
				$err = 'OK';
			} else {
				$err = 'ERR'; //.$user_katamasuk.":".$pass;
			}
		}
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