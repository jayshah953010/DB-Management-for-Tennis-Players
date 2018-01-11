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
	$stid = oci_parse($conn,"select t,firstname,lastname,m,s from player, (select * from 
	(select tid as t,minutes as m,lid as l,wid as w,score as s from tournament_match where tid in (select tid as t from tournament where tname='US Open' or tname='Australian Open' or tname='Roland Garros' or tname='Wimbledon') and minutes is not null order by minutes desc) where rownum<2) where pid=l or pid=w");
	$stid1=oci_parse($conn,"select tname from tournament where tid in (select * from (select tid from tournament_match 
	where tid in (select tid from tournament where tname='US Open' or tname='Australian Open' or tname='Roland Garros' or tname='Wimbledon') and minutes is not null order by minutes desc) where rownum<2)");
	$r = oci_execute($stid);
	$r1 = oci_execute($stid1);
	if(!$r)
	{

	}
	else 
	{
			$num1 = oci_fetch_row($stid);
			$num2 = oci_fetch_row($stid);
			$num3 = oci_fetch_row($stid1);
			$arr = explode ("\-", $num1[0]);
			echo "<h3><center>";//echo " Longest grand slam match - ";
			echo " In " . $num3[0] . " " . $arr[0] . ", final was played between <br> " . $num2[1] . " ".$num2[2] . 
			" and  " . $num1[1] . "  "  .$num1[2] . " whose duration was " . $num2[3] . " minutes <br> with score " . $num1[4]. ". ";
			echo"<br>";
		
    }
	
}

?>
