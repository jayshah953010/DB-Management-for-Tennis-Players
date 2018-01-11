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
	if(isset($_GET['id']))
	{
		$tn = $_GET['id']; //tnaem
		$f = $_GET['id1']; //year

		echo '<div class="half"> <h3>Statistics</h3> <div class="borderedclass"> <form name="myForm">
		<label class="left" for="gen">Year</label>';
		echo "<select class='right'><option selected='".$f."'>".$f."</option></select>";
 
		$i=1;
		echo '<label class="left" for="gen">Tournament</label>';
		echo "<select class='right'><option selected='".$tn."'>".$tn."</option></select>";
		
		$stid = oci_parse($conn, "select f1,l1,f2,l2 from (select firstname as f1,lastname as l1,m1 from player,(select wid as wc,lid as lc,mid as m1 FROM tournament_match,tournament where tournament.tid like '$f%' and tournament.tid=tournament_match.tid and tournament.tname='$tn' order by tournament.tid) where wc=pid), (select firstname as f2,lastname as l2,m2 from player,(select wid as wc,lid as lc,mid as m2 FROM tournament_match,tournament where tournament.tid like '$f%' and 
			tournament.tid=tournament_match.tid and tournament.tname='$tn' order by tournament.tid) where lc=pid) 
			where m1=m2");
		$r = oci_execute($stid);
	
 		echo '<label class="left" for="gen">Match</label>';
		$i=1;
		echo "<select class='right' id='selectBox1'>";
		while($num = oci_fetch_array($stid)) 
		{	 

       	 	echo "<option value='".$num[0]."'>".$num[0]. " " .$num[1]."  vs  ". $num[2]. " ". $num[3]."</option>";
        	$i++;
    	}
    	echo "</select></form></div></div>";
	}
	else
	{

	}
}

?>