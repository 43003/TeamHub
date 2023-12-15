<?php
include '../../connection/common.php';

$pro=isset($_GET["pro"])?$_GET["pro"]:"";
$ids=isset($_REQUEST["ids"])?$_REQUEST["ids"]:"";

// foreach ($_POST as $key => $value) {
//     echo "Field ".$key." = ";
//     print_r($value);
//     echo " <br>";
// }
// exit();

if($pro=='SAVE'){
    try {
        if(empty($ids)){
            $sql="INSERT INTO `course`(`lecturer_ID`, `course_code`, `course_name`, `course_description`, `course_status`,`is_deleted`) 
            VALUES (".tosql($_SESSION['SESS_UID']).",".tosql($course_code).",".tosql($course_name).",".tosql($description).",".tosql($status).",'0')";

        } else {
            $sql="UPDATE `course` SET `course_code`=".tosql($course_code).",`course_name`=".tosql($course_name).",
            `course_description`=".tosql($description).",`course_status`=".tosql($status)." WHERE `course_ID`=".tosql($ids);

        }
        $conn->execute($sql);
		$err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if($pro=='DEL'){
    try {
        $sql="UPDATE `course` SET `is_deleted`='1' WHERE `course_ID`=".tosql($ids);

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