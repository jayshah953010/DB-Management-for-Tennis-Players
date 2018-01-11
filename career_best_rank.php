<?php include 'FINAL_HEADER.php'; ?>

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
	
	$stid1 = oci_parse($conn,"create view daterating as select rating as r1, rdate as rd from rating where pid = 105777 order by RD asc");
	$stid2 = oci_parse($conn,"create view hello as select count(*) as rank, rating.RDATE from rating, daterating where rating >= daterating.r1 and daterating.rd = rdate group by rdate");
	$stid4 = oci_parse($conn,"create view minRank as select min(rank) as minimunRank from (select * from hello order by rdate asc)");
	
	$stid3 = oci_parse($conn,"select * from (select rank,rdate from hello, minRank where minimunRank = hello.RANK order by rdate asc) where rownum<2");
	$r1 = oci_execute($stid1);
	$r2 = oci_execute($stid2);
	$r4 = oci_execute($stid4);
	$r3 = oci_execute($stid3);

	$num = oci_fetch_row($stid3);

	if(!$r3)
	{

	}
	else
	{
    		echo "<center><h3>" . $num[0] . " has rank " . $num[1] . " " . $num[2] ."</h3></center>" ;
    }
	$stid4 = oci_parse($conn,"drop view daterating");
	$stid5 = oci_parse($conn,"drop view hello");
	$stid6 = oci_parse($conn,"drop view minRank");
	$r4 = oci_execute($stid4);
	$r5 = oci_execute($stid5);
	$r6 = oci_execute($stid6);
}

?>