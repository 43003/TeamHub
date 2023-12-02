<?php
$ip = $_SERVER['HTTP_HOST'];
//$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$actual_link_mobile .="?z=0";

if($ip=='localhost'){

	// $actual_link = 'https://localhost/e_jawi/index.php?data='.$data;

	$username="root"; //------------your username usually root
	$password="";//---------your password
	$database="ecert";//----the name of the database
	$DB_hostname='localhost';

} else {
	//connection 
	$username="ecert"; //------------your username usually root
	$password="gk4R!5M2ByV36$"; // PWD baru 2
	$database="ecert"; //"dbemuallaf";//----the name of the database
	$DB_hostname="mysqlv8-dev"; //'jakimdb';

	// $usernameHalal = "ecert";
	// $passwordHalal = "gk4R!5M2ByV36$";
	// $databaseHalal = "db_halal";
	// $DB_hostnameHalal = "mysqlv8-dev"; 
}


$conn = mysqli_connect($DB_hostname, $username, $password, $database);
// $connHalal = mysqli_connect($DB_hostnameHalal, $usernameHalal, $passwordHalal, $databaseHalal);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}
//$conn->debug=1;
$conn = ADONEWConnection('mysqli');
$conn->Connect($DB_hostname, $username, $password, $database);

// $connHalal = ADONEWConnection('mysqli');
// $connHalal->Connect($DB_hostnameHalal, $usernameHalal, $passwordHalal, $databaseHalal);
//exit;
?>