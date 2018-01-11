<?php
include 'FINAL_HEADER.php';

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
	$p1f = $_GET['p1fname'];
	$p2f = $_GET['p2fname'];
	$p1l = $_GET['p1lname'];
	$p2l = $_GET['p2lname'];
	//$p1f = "Roger";
	//$p1l = "Federer";
	//$p2f = "Rafael";
	//$p2l = "Nadal";

	$stid1 = oci_parse($conn, "select pid from player where firstname='$p1f' and lastname='$p1l'");
	$r1 = oci_execute($stid1);
	$num1 = oci_fetch_row($stid1);
	echo $num1[0] . "<br>";

	$stid2 = oci_parse($conn, "select pid from player where firstname='$p2f' and lastname='$p2l'");
	$r2 = oci_execute($stid2);
	$num2 = oci_fetch_row($stid2);
	echo $num2[0];

	
}
?>