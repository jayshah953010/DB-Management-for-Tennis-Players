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
	$stid = oci_parse($conn,"select tname,t1,m1,f1,l1,k1 from tournament, (select tid as t1,mid as m1,firstname as f1,lastname as l1, m1 as k1 from player, (select tid,mid,wid as win, lid as lin, minutes as m1 from tournament_match where minutes in (select max(minutes) as longest_match from tournament_match where tid like '2005%') and tid like '2005%') where win=pid or lin=pid) where tournament.tid=t1");
	$stid1 = oci_parse($conn,"select tname,t1,m1,f1,l1,k1 from tournament, (select tid as t1,mid as m1,firstname as f1,lastname as l1, m1 as k1 from player, (select tid,mid,wid as win, lid as lin, minutes as m1 from tournament_match where minutes in (select min(minutes) as longest_match from tournament_match where tid like '2005%') and tid like '2005%') where win=pid or lin=pid) where tournament.tid=t1");

	$r = oci_execute($stid);
	$r1 = oci_execute($stid1);

	if(!$r and !$r1)
	{

	}
	else 
	{
		if($r)
		{
			$num1 = oci_fetch_row($stid);
			$num2 = oci_fetch_row($stid);
			$arr = split ("\-", $num1[1]);
			echo "<h3><center>";
			echo " In " . $num1[0] . " " . $arr[0] . ", " . " ".$num1[3] . "  " . $num1[4] . "  vs "  .$num2[3] . " " . 
			$num2[4] ." took " . $num2[5] . " minutes.</center></h3> <br> ";
			echo"<br>";
		}
		
		if($r1)
		{
			$num1 = oci_fetch_row($stid1);
			$num2 = oci_fetch_row($stid1);
			$arr1 = split ("\-", $num1[1]);
			echo "<h3><center>";
			echo " In " . $num1[0] . " " . $arr1[0] . ", " . " ".$num1[3] . "  " . $num1[4] . "  vs "  .$num2[3] . " " . 
			$num2[4] ." took " . $num2[5] . " minutes.</center></h3>";
		}
    }
	
}

?>
