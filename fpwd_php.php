
<?php

// Connects to the XE service (i.e. database) on the "localhost" machine
$u="rao";
$p="Pratham123";
$db="oracle.cise.ufl.edu/orcl";
$conn = oci_connect($u,$p,$db);

if(!$conn) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else
{
	$u = $_GET['email'];
	$stid = oci_parse($conn, "SELECT * FROM FAN where uname='$u'");
	$r = oci_execute($stid);
	$num = oci_fetch_row($stid);
	
	if($num[0]==null)
	{
			header("Location: http://localhost/testing/fpwd.php");
			//dashboard
	}
	else
	{
		//
		echo $num[1]." ".$num[0];
		$password = $num[1];
		$subject = "Your Recovered Password";
		$message = "Please use this password to login " . $password;
		
		$headers =  'MIME-Version: 1.0' . "\r\n"; 
		$headers .= "From : bansari201201098@gmail.com" . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		if(mail($u, $subject, $message, $headers))
		{
            echo "Your Password has been sent to your email ID";
        }
        else
        {
            echo "Failed to Recover your password, try again";
		}
		//header("Location: http://localhost/testing/login.php");
	}
}
?>