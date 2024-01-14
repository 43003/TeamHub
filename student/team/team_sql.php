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

if($pro=='CHANGE'){
    $team=isset($_REQUEST["team"])?$_REQUEST["team"]:"";
    $team_id=isset($_REQUEST["team_id"])?$_REQUEST["team_id"]:"";
    try {

        $conn->execute("UPDATE `team` SET number_of_student=number_of_student-1 WHERE team_ID=".tosql($team));

        $conn->execute("UPDATE `team` SET number_of_student=number_of_student+1 WHERE team_ID=".tosql($team_id));

        $sql="UPDATE `student_course` SET `team_ID`=".tosql($team_id)." WHERE `student_ID`=".tosql($_SESSION['SESS_UID']);
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