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
	$stid1 = oci_parse($conn, "select firstname,lastname,win_percent,lc,wc from player,(select lid,(wc/(lc+wc))*100 as win_percent,lc,wc from (select lid,count(*) as lc from loser group by lid), (select wid,count(*)as wc from winner group 
		by wid) where lid=wid and (lc+wc)>=50 order by (wc/(lc+wc)) desc) where rownum<2 and pid=lid");
	$r1 = oci_execute($stid1);
	$num = oci_fetch_row($stid1);

	if(!$r1)
	{

	}
	else
	{
    		echo "<center><table><tr><td><h3>".$num[0] . " " . $num[1] . " has winning percent of " . round($num[2],2) . ".</h3>
    		</td></tr></table></center>" ;
    }
}

?>