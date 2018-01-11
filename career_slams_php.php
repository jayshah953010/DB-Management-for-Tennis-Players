<?php
include 'FINAL_HEADER.php';
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
	$stid = oci_parse($conn,"select firstname,lastname from player, (select champion from tournament where tname='US Open' intersect 
	select champion from tournament where tname='Australian Open' intersect select champion from tournament where tname='Roland Garros'
	intersect select champion from tournament where tname='Wimbledon') where pid = champion");
	$r = oci_execute($stid);

	echo "<center><table> <h3>Career Slams</h3>";
	echo "<tr><td>Sr. No.</td><td><h4>"." " . "Player" . "<br></h4></td></tr>";
	if(!$r)
	{

	}
	else
	{
		$num = oci_fetch_row($stid);
		$i=1;
		while($num!=null)
		{
			echo "<tr><td>".$i."</td><td><h4>".$num[0] . " " . $num[1] . "<br></h4></td></tr>" ;
    		$num = oci_fetch_row($stid);
    		$i++;
		}
    }
	echo "</table></center><br><br>";
}

?>