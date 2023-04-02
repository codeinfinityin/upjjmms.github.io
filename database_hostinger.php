<?php
  define('HOST','mysql.hostinger.in');
  define('USER','u107985738_datahart');
  define('PASS','Prasad@1911');
  define('DB','u107985738_datahart');
  $con = mysqli_connect(HOST,USER,PASS,DB);
  if(mysqli_connect_errno($con))
{
		echo 'Failed to connect';
}

?>