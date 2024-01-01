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

if($pro=='STATUS'){
    try {
        $sql="UPDATE `student_course` SET `status`='1' WHERE course_ID=".tosql($ids)." AND `status`='0'";
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