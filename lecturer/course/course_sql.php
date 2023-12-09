<?php
include '../../connection/common.php';

$pro=isset($_GET["pro"])?$_GET["pro"]:"";
$course_code=isset($_REQUEST["course_code"])?$_REQUEST["course_code"]:"";
$course_name=isset($_REQUEST["course_name"])?$_REQUEST["course_name"]:"";
$description=isset($_REQUEST["description"])?$_REQUEST["description"]:"";
$status=isset($_REQUEST["status"])?$_REQUEST["status"]:"";

if($pro=='SAVE'){
    // $conn->debug=true;
    $sql="INSERT INTO `course`(`lecturer_ID`, `course_code`, `course_name`, `course_description`, `course_status`,`is_deleted`) 
    VALUES (".tosql($_SESSION['SESS_UID']).",".tosql($course_code).",".tosql($course_name).",".tosql($description).",".tosql($status).",'0')";

    $rss = $conn->execute($sql);
    if($rss){
		$err='OK';
    } else {
		$err='ERR'; 
    }

}

header("Content-Type: text/json");
print json_encode($err); 
?>