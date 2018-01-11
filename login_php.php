
<?php
session_start();
?>

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

	$u1 = $_GET['username'];
	
	$p = $_GET['password'];
	$stid = oci_parse($conn, "SELECT * FROM FAN where ID='$u1' and PASSWORD='$p'");
	$r = oci_execute($stid);
	$num = oci_fetch_row($stid);
	//echo $u;
	if($num[0]!=null)
	{
		$_SESSION['user'] = $u1;
		header("Location: http://localhost/testing/dashboard.php");
	}
	else
	{
		echo "<script>
		alert('Invalid Username or Password');
		window.location.href='//localhost/testing/login.php';
		</script>";

	}
}
?>
