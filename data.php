<?php
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
	echo "<script>
		alert('Invalid Username or Password');
		</script>";
	$stid = oci_parse($conn, "select  P1,T1,TM1, TMW1, TML1, RD,( P1+T1+TM1+TMW1+TML1+RD) as Total from
    (select count(*) as P1 from Player), (select count(*) as T1 from tournament), (select count(*) as TM1 from tournament_match),
    (select count(*) as TMW1 from Winner), (select count(*) as TML1 from loser), (select count(*) as RD from rating)");
	$r = oci_execute($stid);

	$num = oci_fetch_row($stid);
	echo "<center><table><tr><td><b>Tables</b></td><td><b>Records</b></td>";
	echo "<center><table><tr><td>Player</td><td>".$num[0]."</td>";
	echo "<center><table><tr><td>Tournament</td><td>".$num[1]."</td>";
	echo "<center><table><tr><td>Tournament_match</td><td>".$num[2]."</td>";
	echo "<center><table><tr><td>Winner</td><td>".$num[3]."</td>";
	echo "<center><table><tr><td>Loser</td><td>".$num[4]."</td>";
	echo "<center><table><tr><td>Rating</td><td>".$num[5]."</td>";
	echo "<center><table><tr><td>Total Records</td><td>".$num[6]."</td>";
	//echo $num[0]." records in the table Player table.";

}
?>