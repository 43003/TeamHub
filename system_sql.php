<?php
include_once 'connection/common.php';

$pro=isset($_GET["pro"])?$_GET["pro"]:"";
$email=isset($_REQUEST["email"])?$_REQUEST["email"]:"";
$password=isset($_REQUEST["password"])?$_REQUEST["password"]:"";
$token=isset($_REQUEST["token"])?$_REQUEST["token"]:"";

$pass = md5($password);

// $conn->debug=true;

if($pro=='LOGIN'){
	if(strpos($email,'@student') !== false) {
		$sql = "SELECT * FROM student WHERE  AND email=".tosql($email);
		$type = "P";
	} else {
		$sql = "SELECT * FROM lecturer WHERE email=".tosql($email);
		$type = "S";
	}
	$rs = $conn->query($sql);
	if($rs->recordcount()>=1){
		if(!$rs->EOF){
			//$err = 'OK';
			@session_start();
			$user_katamasuk = $rs->fields['password'];
			
			if($user_katamasuk == $pass){
				$_SESSION['SESS_TYPE']=$type;
				if ($type == "P") {
					$_SESSION['SESS_UID']=$rs->fields['student_ID'];
					$_SESSION['SESS_NAME']=$rs->fields['student_name'];
					$_SESSION['SESS_EMEL']=$rs->fields['email'];
				} else if($type == "S") {
					$_SESSION['SESS_UID']=$rs->fields['lecturer_ID'];
					$_SESSION['SESS_NAME']=$rs->fields['lecturer_name'];
					$_SESSION['SESS_EMEL']=$rs->fields['email'];
				}
				
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