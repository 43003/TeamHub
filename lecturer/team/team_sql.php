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

} else if ($pro=="NEW") {
    $student=isset($_REQUEST["student"])?$_REQUEST["student"]:"";

    try {
        // $conn->debug=true;
        $teamName=dlookup("team","team_name","course_ID=".tosql($ids)." ORDER BY team_name DESC");
        if(!empty($teamName)){
            $initial=str_split(explode(" ",$teamName)[1])[0];
            $initial=++$initial;
        } else {
            $initial='A';
        }

        $sqlTeam="INSERT INTO `team`(`course_ID`, `number_of_student`, `team_name`, `team_status`) VALUES (".tosql($ids).",".tosql(count($student)).",".tosql("Team ".$initial).", 0)";
        $conn->query($sqlTeam);
        $last_id = $conn->insert_Id();
        
        for ($i=0; $i < count($student); $i++) {
            $sqlStudent="UPDATE `student_course` SET `team_ID`=".tosql($last_id)." WHERE `course_ID`=".tosql($ids)." AND `student_ID`=".tosql($student[$i]);
            $conn->query($sqlStudent);
        }

        $err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if ($pro=="GENERATE") {
    $no_member=isset($_REQUEST["no_member"])?$_REQUEST["no_member"]:"";

    try {
        // $conn->debug=true;
        $sql="SELECT * FROM `student_course` WHERE `course_ID`=".tosql($ids)." AND `team_ID` IS NULL";
        $rs = $conn->query($sql);

        $countRS = $rs->recordcount();

        $teams=array();
        while (!$rs->EOF) {
            array_push($teams,$rs->fields["student_ID"]);
            $rs->movenext();
        }

        shuffle($teams);

        $teamName=dlookup("team","team_name","course_ID=".tosql($ids)." ORDER BY team_name DESC");
        if(!empty($teamName)){
            $initial=str_split(explode(" ",$teamName)[1])[0];
            $initial=++$initial;
        } else {
            $initial='A';
        }
        
        for ($i=0; $i < $countRS; $i++) {
            if($i%$no_member==0){
                $sqlTeam="INSERT INTO `team`(`course_ID`, `number_of_student`, `team_name`, `team_status`) VALUES (".tosql($ids).",".tosql(count($student)).",".tosql("Team ".$initial).", 0)";
                $conn->query($sqlTeam);
                $last_id = $conn->insert_Id();
                $initial++;
            }
            
            $sqlStudent="UPDATE `student_course` SET `team_ID`=".tosql($last_id)." WHERE `course_ID`=".tosql($ids)." AND `student_ID`=".tosql($teams[$i]);
            $conn->query($sqlStudent);
        }
        $err='OK';
    } catch (\Throwable $th) {
        // throw $th;
        $err='ERR';
    }

} else if ($pro=="JOIN") {
    $team=isset($_REQUEST["team"])?$_REQUEST["team"]:"";
    $student=isset($_REQUEST["student"])?$_REQUEST["student"]:"";

    try {
        // $conn->debug=true;
        $num=dlookup("team","number_of_student","team_ID=".tosql($team))+1;

        $sqlTeam="UPDATE `team` SET `number_of_student`=".tosql($num)." WHERE team_ID=".tosql($team);
        $conn->query($sqlTeam);

        $chckLeader = dlookup_cnt("student_course","is_leader","course_ID=".tosql($ids)." AND team_ID=".tosql($team)." AND is_leader='Y'");

        if($chckLeader == 0) {
            $sqlStudent="UPDATE `student_course` SET `team_ID`=".tosql($team)." WHERE student_ID=".tosql($student)." AND course_ID=".tosql($ids);
        } else {
            $sqlStudent="UPDATE `student_course` SET `team_ID`=".tosql($team).", `is_leader`='N' WHERE student_ID=".tosql($student)." AND course_ID=".tosql($ids);
        }

        $conn->query($sqlStudent);

        $err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if ($pro=="LEADER") {
    $team=isset($_REQUEST["team"])?$_REQUEST["team"]:"";
    $student=isset($_REQUEST["student"])?$_REQUEST["student"]:"";

    try {
        // $conn->debug=true;
        // Leader
        $conn->query("UPDATE `student_course` SET `is_leader`='Y' WHERE course_id=".tosql($ids)." AND team_ID=".tosql($team)." AND student_ID=".tosql($student));

        // Members
        $conn->query("UPDATE `student_course` SET `is_leader`='N' WHERE course_id=".tosql($ids)." AND team_ID=".tosql($team)." AND student_ID<>".tosql($student));

        $err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if ($pro=="DISBAND") {
    $team=isset($_REQUEST["team"])?$_REQUEST["team"]:"";
    
    try {
        // $conn->debug=true;
        // Disband All Member
        $conn->query("UPDATE `student_course` SET `team_ID`=NULL, `is_leader`=NULL WHERE course_id=".tosql($ids)." AND team_ID=".tosql($team));

        // Change Status of Team
        $conn->query("UPDATE `team` SET `team_status`=1 WHERE team_ID=".tosql($team));

        $err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

}

header("Content-Type: text/json");
print json_encode($err); 
?>