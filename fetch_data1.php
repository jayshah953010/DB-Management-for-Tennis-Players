<?php
//if(isset($_POST['get_option']))
//{
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
		if(isset($_POST['get_option']))
 		{
 			$tn = $_POST['get_option']; //
 			$f = $_POST['get_option1'];

 			//echo "<script>alert('$fmblfmb');</script>";
 			$stid = oci_parse($conn, "select f1,l1,f2,l2,m1 from (select firstname as f1,lastname as l1,m1 from player,(select wid as wc,lid as lc,mid as m1 FROM tournament_match,tournament where tournament.tid like '$f%' and tournament.tid=tournament_match.tid and tournament.tname='$tn' order by tournament.tid) where wc=pid), (select firstname as f2,lastname as l2,m2 from player,(select wid as wc,lid as lc,mid as m2 FROM tournament_match,tournament where tournament.tid like '$f%' and tournament.tid=tournament_match.tid and tournament.tname='$tn' order by tournament.tid) where lc=pid) where m1=m2");
			$r = oci_execute($stid);
			echo "<select class='right' >";
			echo "<option value=''>-</option>";
			while($num = oci_fetch_array($stid)) 
			{	 
				//$r1 = $num[4]." ".$num[5]." ".$num[6];
       	 		echo "<option value='".$num[4]."'>".$num[0]. " " .$num[1]."  vs  ". $num[2]. " ". $num[3]."</option>";
    		}

    		echo "</select>";
 		}
 	}
?>