
<?php
include 'FINAL_HEADER.php';
	$u="jsshah";
	$p="Yash!12081997";
	$db="oracle.cise.ufl.edu/orcl";
	$conn = oci_connect($u,$p,$db);
	//include 'FINAL_HEADER.php';

	if(!$conn) 
	{
    	$e = oci_error();
    	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	else
	{
		//echo "BAnsar";
 		$f = $_GET['year'];
 		//echo $y;
 		$tn = $_GET['tour'];
 		//echo $t;
 		$m = $_GET['match'];
 		//echo $m."<br>";

 		$stid = oci_parse($conn, "select f1,l1,f2,l2,m1,s,r,mi from (select firstname as f1,lastname as l1,m1,s,r,mi from player,(select wid as wc,lid as lc,mid as m1,score as s,round as r,minutes as mi FROM tournament_match,tournament where tournament.tid like '$f%' and tournament.tid=tournament_match.tid and tournament.tname='$tn' order by tournament.tid) where wc=pid), (select firstname as f2,lastname as l2,m2 from player,(select wid as wc,lid as lc,mid as m2 FROM tournament_match,tournament where tournament.tid like '$f%' and tournament.tid=tournament_match.tid and tournament.tname='$tn' order by tournament.tid) where lc=pid) where m1=m2 and m1='$m'");
 		$r = oci_execute($stid);
 		$num = oci_fetch_row($stid);

 		print '<center><table border="1">';
 		print '<tr><td><b>'."Tournament".'</b></td><td>' . $tn.'</td></tr>';
 		print '<tr><td><b>'."Round".'</b></td><td>' . $num[6].'</td></tr>';
 		print '<tr><td><b>'."Winner".'</b></td><td>' . $num[0]. " ". $num[1] . '</td></tr>';
 		print '<tr><td><b>'."Loser".'</b></td><td>' . $num[2]. " ". $num[3] . '</td></tr>';
 		print '<tr><td><b>'."Score".'</b></td><td>' . $num[5].'</td></tr>';
 		print '<tr><td><b>'."Minutes".'</b></td><td>' . $num[7].'</td></tr>';
 		echo "</table></center><br><br>";


 	}
 ?>