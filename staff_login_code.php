<?php 
include 'database.php';
session_start();	
$username= mysqli_real_escape_string($con,$_POST['username']);
$username = filter_var($username, FILTER_SANITIZE_EMAIL);
$password= mysqli_real_escape_string($con,$_POST['password']);
$password = filter_var($password, FILTER_SANITIZE_STRING);
if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}
	if(!isset($_POST['tokenp'])){
		echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('ERROR ! Please do login again')
				 window.location.href='index.php';
				</SCRIPT>");
	}
	else if(hash_equals($_POST['tokenp'], $_SESSION['tokenp']) === false){
		echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('ERROR ! Please do login again')
				 window.location.href='index.php';
				</SCRIPT>");
	}
	else if($username=="" || $password=="")
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Please enter valid Email Id, Password for Login')
				 window.location.href='index.php';
				</SCRIPT>");		
	}
	else
	{
		//$password = hash("sha512", $password);
		$stmt = $con->prepare("SELECT adm_mail_id, adm_pass FROM admin_details WHERE adm_mail_id=? AND adm_pass=? LIMIT 1");
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$stmt->bind_result($username, $password);
		$stmt->store_result();
		
		if($stmt->num_rows == 1)		
		{	
			$_SESSION['sid']=session_id();
			$sql ="select * from admin_details where adm_mail_id = '$username' AND adm_pass = '$password'";
			$res = mysqli_query($con,$sql);
			$result = array();
			while($row = mysqli_fetch_array($res))
			{
				$aid=$row['adm_id'];
				$aname = $row['adm_name'];
			}
			
			$_SESSION['aid'] = $aid;
			$_SESSION['aname'] = $aname;
			
			/*echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Welcome to Admin Panel')
				 window.location.href='dashboard.php';
				</SCRIPT>");*/
			header("location: dashboard.php");	
		}
		else{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Wrong Username or Password')
				 window.location.href='index.php';
				</SCRIPT>");
		}
		mysqli_close($con);
	}	
?>		