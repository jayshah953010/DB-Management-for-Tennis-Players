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
	//$g = $_GET['year'];
	$g=2016;
	$start = microtime(true);
	
	$stid = oci_parse($conn,"create view w_1 as select tournament.tid as T1,tournament.tdate as D1,tournament_match.wid as W1,tournament_match.lid as L1 from tournament,tournament_match where tournament.tid = tournament_match.tid and 
		tournament.year = '$g' order by tournament.tdate asc");
	$r = oci_execute($stid);

	$stid2 = oci_parse($conn,"select W1 from w_1 having count(W1) > 5 group by W1 order by count(W1) desc");
	$r2 = oci_execute($stid2);

	
	$max=0;
	$pid = 0;
	while ($row1 = oci_fetch_row($stid2))// OCI_ASSOC+OCI_RETURN_NULLS)) 
	{
		//echo $row1[0]." ** ";
	$stid7 = oci_parse($conn,"select W1 from w_1 where W1 = '$row1[0]' or L1 = '$row1[0]'");
	$r7 = oci_execute($stid7);


	$count=0;
	

	while ($row = oci_fetch_row($stid7))// OCI_ASSOC+OCI_RETURN_NULLS)) 
	{
		if($row[0] == $row1[0])
		{
			$count++;
		}
		else
		{
			if($max < $count)
			{
				$max = $count;
				$pid = $row1[0];
			}
			$count = 0;
		}
	}

	
	}
	$time_elapsed_secs = microtime(true) - $start;
	
	echo "<br>dbhc ".$max." ".$pid. " ".$time_elapsed_secs;


	$stid5 = oci_parse($conn,"drop view w_1");
	$r5 = oci_execute($stid5);


}
?>
