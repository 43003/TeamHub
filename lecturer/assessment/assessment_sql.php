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
    $course=isset($_REQUEST["course"])?$_REQUEST["course"]:"";
    $assessment_type=isset($_REQUEST["assessment_type"])?$_REQUEST["assessment_type"]:"";
    $assessment_title=isset($_REQUEST["assessment_title"])?$_REQUEST["assessment_title"]:"";
    $assessment_document=isset($_REQUEST["assessment_document"])?$_REQUEST["assessment_document"]:"";
    $date_start=isset($_REQUEST["date_start"])?$_REQUEST["date_start"]:"";
    $date_end=isset($_REQUEST["date_end"])?$_REQUEST["date_end"]:"";

    try {
		if(!empty($_FILES['assessment_document']['name'])){
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf', 'JPEG', 'JPG', 'PNG', 'GIF', 'PDF'); // valid extensions
			$path = '../../uploads/assessment/'; // upload directory
			
			$img = $_FILES['assessment_document']['name'];
			$tmp = $_FILES['assessment_document']['tmp_name'];
	
			$ext = end((explode(".", $img))); 
			$fname = $ids."_assessment.".$ext;
			$fname = str_replace(" ", "_", $fname);
			$fname = str_replace("-", "_", $fname);
			
			// $final_image = "perubahanNamaItem_".$appli_id.".".$ext;
			$final_image = strtolower(rand(1000,1000000)."_".$fname);
			// print $final_image;
			if(in_array($ext, $valid_extensions)){ 
				$path = $path.$final_image; 
				move_uploaded_file($tmp,$path);
			}
		}

        if(empty($ids)){
    
            $sqli="INSERT INTO `assessment`(`course_ID`, `title`, `category`, `docs`, `start_date`, `due_date`, `is_deleted`)  
            VALUES (".tosql($course).",".tosql($assessment_title).",".tosql($assessment_type).",".tosql($final_image).",".tosql($date_start).",".tosql($date_end).",'0')";
        
            $conn->execute($sqli);
        
            $aid = $conn->insert_Id();

            $student = $conn->query("SELECT * FROM student_course WHERE course_ID=".tosql($course)." AND status <> 9");

            while (!$student->EOF) {
                $sql="INSERT INTO `task_assign`(`student_course_ID`, `assessment_ID`, `status`)  
                VALUES (".tosql($student->fields['student_course_ID']).",".tosql($aid).",'0')";
                
                $conn->execute($sql);

                $student->movenext();
            }

        } else {
            $sql="UPDATE `course` SET `title`=".tosql($assessment_title).",`docs`=".tosql($final_image).
            ", `start_date`=".tosql($date_start).",`due_date`=".tosql($date_end)." WHERE `course_ID`=".tosql($ids);

            $conn->execute($sql);
        }

		$err='OK';
    } catch (\Throwable $th) {
        // throw $th;
        $err='ERR';
    }

} else if($pro=='DEL'){
    try {
        $sql="UPDATE `assessment` SET `is_deleted`='1' WHERE `assessment_ID`=".tosql($ids);

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