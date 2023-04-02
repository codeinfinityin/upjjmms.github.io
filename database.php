<?php
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB','upjjmms');
//$con = mysqli_connect(HOST,USER,PASS,DB);
$con = new mysqli(HOST,USER,PASS,DB);
/* if(mysqli_connect_errno($con))
{
	echo 'Failed to connect';
}
*/
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>