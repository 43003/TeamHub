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
			$path = '../../uploads/lecturer/'; // upload directory
			
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

        $sql="UPDATE `lecturer` SET `pic`=".tosql($final_image)." WHERE `lecturer_ID`=".tosql($_SESSION["SESS_UID"]);

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
        $sql="UPDATE `lecturer` SET `lecturer_name`=".tosql(strtoupper($lecturer_name)).",`mobile_phone`=".tosql($mobile_phone).",
        `office_phone`=".tosql($office_phone).",`office_location`=".tosql(strtoupper($office_location)).",`description`=".tosql($description)." WHERE `lecturer_ID`=".tosql($_SESSION["SESS_UID"]);
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