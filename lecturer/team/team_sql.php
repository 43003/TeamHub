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
        $sql="UPDATE `student_course` SET `status`='1' WHERE `course_ID`=".tosql($ids)." AND `status`='0'";
        $conn->execute($sql);
		$err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if ($pro=="GENERATE") {
    $no_member=isset($_REQUEST["no_member"])?$_REQUEST["no_member"]:"";
    $student=isset($_REQUEST["student"])?$_REQUEST["student"]:"";

    try {
        $sql="SELECT * FROM `student_course` WHERE `course_ID`=".tosql($ids);
        if (!empty($student)) {
            $sql .= " AND `student_ID` NOT IN ('".implode("','",$student)."')";
        }

        $rs = $conn->query($sql);
        $countRS = $rs->recordcount();

        $teams=array();
        while (!$rs->EOF) {
            array_push($teams,$rs->fields["student_ID"]);
            $rs->movenext();
        }

        array_rand($teams);
        $initial='A';
        
        for ($i=0; $i < $countRS; $i++) {
            if($i%$no_member==0){
                $sqlTeam="INSERT INTO `team`(`course_ID`, `number_of_student`, `team_name`) VALUES (".tosql($ids).",".tosql($no_member).",".tosql("Team ".$initial).")";
                $conn->query($sqlTeam);
                $last_id = $conn->insert_Id();
                $initial++;
                $teamLeader="Y";
            } else {
                $teamLeader="N";
            }
            
            $sqlStudent="UPDATE `student_course` SET `team_ID`=".tosql($last_id).", `is_leader`=".tosql($teamLeader)." WHERE `course_ID`=".tosql($ids)." AND `student_ID`=".tosql($teams[$i]);
            $conn->query($sqlStudent);
        }
        $err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if ($pro=="NEW") {
    $student=isset($_REQUEST["student"])?$_REQUEST["student"]:"";

    try {
        // $conn->debug=true;
        $teamName=dlookup("team","team_name","course_ID=".tosql($ids)." ORDER BY team_name DESC");
        $initial=str_split(explode(" ",$teamName)[1]);

        $sqlTeam="INSERT INTO `team`(`course_ID`, `number_of_student`, `team_name`) VALUES (".tosql($ids).",".tosql(count($student)).",".tosql("Team ".++$initial[0]).")";
        $conn->query($sqlTeam);
        $last_id = $conn->insert_Id();
        
        for ($i=0; $i < count($student); $i++) {
            if($i==0){
                $teamLeader="Y";
            } else {
                $teamLeader="N";
            }
            $sqlStudent="UPDATE `student_course` SET `team_ID`=".tosql($last_id).", `is_leader`=".tosql($teamLeader)." WHERE `course_ID`=".tosql($ids)." AND `student_ID`=".tosql($student[$i]);
            $conn->query($sqlStudent);
        }

        $err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if ($pro=="JOIN") {
    $team=isset($_REQUEST["team"])?$_REQUEST["team"]:"";
    $student=isset($_REQUEST["studentID"])?$_REQUEST["studentID"]:"";

    try {
        // $conn->debug=true;
        $num=dlookup("team","number_of_student","team_ID=".tosql($team))+1;

        $sqlTeam="UPDATE `team` SET `number_of_student`=".tosql($num)." WHERE team_ID=".tosql($team);
        $conn->query($sqlTeam);

        $sqlStudent="UPDATE `student_course` SET `team_ID`=".tosql($team)." WHERE student_ID=".tosql($student)." AND course_ID=".tosql($ids);
        $conn->query($sqlStudent);

        $err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

}

header("Content-Type: text/json");
print json_encode($err); 
?>