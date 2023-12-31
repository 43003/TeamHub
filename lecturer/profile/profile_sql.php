<?php
include '../../connection/common.php';

$pro=isset($_GET["pro"])?$_GET["pro"]:"";

// foreach ($_POST as $key => $value) {
//     echo "Field ".$key." = ";
//     print_r($value);
//     echo " <br>";
// }
// exit();

if($pro=='PIC'){
    try {
        $sql="UPDATE `course` SET `is_deleted`='1' WHERE `course_ID`=".tosql($ids);

        $conn->execute($sql);
		$err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if($pro=='INFO'){
    
    $lecturer_name=isset($_REQUEST["lecturer_name"])?$_REQUEST["lecturer_name"]:"";
    $mobile_phone=isset($_REQUEST["mobile_phone"])?$_REQUEST["mobile_phone"]:"";
    $office_phone=isset($_REQUEST["office_phone"])?$_REQUEST["office_phone"]:"";
    $office_location=isset($_REQUEST["office_location"])?$_REQUEST["office_location"]:"";
    $description=isset($_REQUEST["description"])?$_REQUEST["description"]:"";

    try {
        $sql="UPDATE `lecturer` SET `lecturer_name`=".tosql($lecturer_name).",`mobile_phone`=".tosql($mobile_phone).",
        `office_phone`=".tosql($office_phone).",`office_location`=".tosql($office_location).",`description`=".tosql($description)." WHERE `lecturer_ID`=".tosql($_SESSION["SESS_UID"]);
        $conn->execute($sql);
		$err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }
}

header("Content-Type: text/json");
print json_encode($err); 
?>