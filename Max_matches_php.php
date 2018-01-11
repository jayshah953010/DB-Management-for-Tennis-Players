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
	
	$stid1 = oci_parse($conn, "create view a2 as select lid,count(*) as w from loser group by lid having 
		count(*)>0 order by w desc");
	$stid2 = oci_parse($conn,"create view b2 as select wid,count(*) as l from winner group by wid having 
		count(*)>0 order by l desc");
	$stid3 = oci_parse($conn,"select firstname,lastname,c2 from player,(select * from (select a2.lid as id,(a2.w+b2.l) as c2 
		from a2,b2 where a2.lid=b2.wid and a2.w+b2.l>0 order by c2 desc) where rownum>0 and rownum<2) where pid=id");
	$r1 = oci_execute($stid1);
	$r2 = oci_execute($stid2);
	$r3 = oci_execute($stid3);
	$num = oci_fetch_row($stid3);

	if(!$r3)
	{

	}
	else
	{
		echo "<h3><center>";
    		echo $num[0] . " " . $num[1] . " has played total " . $num[2] . " matches. </center></h3> " ;
    }
	$stid4 = oci_parse($conn,"drop view a2");
	$stid5 = oci_parse($conn,"drop view b2");
	$r4 = oci_execute($stid4);
	$r5 = oci_execute($stid5);
}

?>