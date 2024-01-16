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
        if(!empty($_FILES['profile_pic']['name'])){
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf', 'JPEG', 'JPG', 'PNG', 'GIF', 'PDF'); // valid extensions
			$path = '../../uploads/student/'; // upload directory
			
			$img = $_FILES['profile_pic']['name'];
			$tmp = $_FILES['profile_pic']['tmp_name'];
	
			$ext = end((explode(".", $img))); 
			$fname = $_SESSION["SESS_UID"]."_profile_pic.".$ext;
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

        $sql="UPDATE `student` SET `pic`=".tosql($final_image)." WHERE `student_ID`=".tosql($_SESSION["SESS_UID"]);

        $conn->execute($sql);
		$err='OK';
    } catch (\Throwable $th) {
        //throw $th;
        $err='ERR';
    }

} else if($pro=='INFO'){
    
    $student_name=isset($_REQUEST["student_name"])?$_REQUEST["student_name"]:"";
    $student_course=isset($_REQUEST["student_course"])?$_REQUEST["student_course"]:"";
    $student_class=isset($_REQUEST["student_class"])?$_REQUEST["student_class"]:"";

    try {
        $sql="UPDATE `student` SET `student_name`=".tosql(strtoupper($student_name)).",`course`=".tosql(strtoupper($student_course)).",
        `class`=".tosql(strtoupper($student_class))." WHERE `student_ID`=".tosql($_SESSION["SESS_UID"]);
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