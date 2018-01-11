
<?php

// Connects to the XE service (i.e. database) on the "localhost" machine
$u="jsshah";
$p="Yash!12081997";
$db="oracle.cise.ufl.edu/orcl";
$conn = oci_connect($u,$p,$db);

if(!$conn) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

else
{
	$e = $_GET['email'];
	$p = $_GET['pwd1'];
	$f = $_GET['fname'];
	$l = $_GET['lname'];
	$c = $_GET['country'];
	$g = $_GET['gender'];
	$d = $_GET['dob'];
	echo "<br>";

	$stid = oci_parse($conn, "SELECT * FROM FAN where ID='$e'");
	$r = oci_execute($stid);
	$num = oci_fetch_row($stid);

	if($num[0]==null)
	{
			//echo "Registered Successfully..!";
			//alert Registered Successfully
			$stid1 = oci_parse($conn,"insert into FAN values('$e','$p','$f','$l','$c','$g',to_date('$d','MM-DD-YYYY'))");
			$r1 = oci_execute($stid1);
			//$num = oci_fetch_row($stid1);
			echo "<script>
					alert('Data Entered..!');
					window.location.href='//localhost/testing/login.php';
				</script>";
	}
	else
	{
		echo "<script>
		alert('Choose another username Registered Unsuccessfully..!');
		window.location.href='//localhost/testing/register.php';
		</script>";
		//window alert
		//header("Location: http://localhost/testing/register.php");
	}
}
?>
