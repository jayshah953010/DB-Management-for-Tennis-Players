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
	$g = $_GET['chose'];
	
	if(isset($_GET['year']))
		$y = $_GET['year'];
	else
		$y=null;
	//$_SESSION['year'] = $y;

	if($g == "MA" && $y!=null)
	{
		//echo $y;
		$stid1 = oci_parse($conn, "create view a2 as select lid,sum(l_ace) as w from loser where tid like '$y%' group by lid having 
		sum(l_ace)>0 order by w desc");
		$stid2 = oci_parse($conn,"create view b2 as select wid,sum(w_ace) as l from winner where tid like '$y%' group by wid having 
		sum(w_ace)>0 order by l desc");
		$stid3 = oci_parse($conn,"select firstname,lastname,c2,pid from player,(select * from (select a2.lid as id,(a2.w+b2.l) as c2 from a2,b2 where a2.lid=b2.wid and a2.w+b2.l>0 order by c2 desc) where rownum>0 and rownum<2) where pid=id");
		$r1 = oci_execute($stid1);
		$r2 = oci_execute($stid2);
		$r3 = oci_execute($stid3);
		$num = oci_fetch_row($stid3);
		//echo $num[3];
		if(!$r3)
		{

		}
		else
		{
    		echo "<center><h3>" . $num[0] . " " . $num[1] . " has " . $num[2] . " aces in " . $y . ".</h3></center>" ;
    	}
		$stid4 = oci_parse($conn,"drop view a2");
		$stid5 = oci_parse($conn,"drop view b2");
		$r4 = oci_execute($stid4);
		$r5 = oci_execute($stid5);
	}
	else if($g == "MA" && $y==null)
	{
		echo '<script type="text/javascript">',
     'drawChart();',
     '</script>';

		$n = array();
		$ma = array();

		for($x=2010;$x<=2016;$x++)
		{
			$stid1 = oci_parse($conn, "create view a2 as select lid,sum(l_ace) as w from loser where tid like '$x%' group by lid having sum(l_ace)>0 order by w desc");
			$stid2 = oci_parse($conn,"create view b2 as select wid,sum(w_ace) as l from winner where tid like '$x%' group by wid having sum(w_ace)>0 order by l desc");
			$stid3 = oci_parse($conn,"select firstname,lastname,c2 from Player,(select * from (select a2.lid as id,(a2.w+b2.l) as c2 from a2,b2 where a2.lid=b2.wid and a2.w+b2.l>0 order by c2 desc) where rownum>0 and rownum<2) where pid=id");
			$r1 = oci_execute($stid1);
			$r2 = oci_execute($stid2);
			$r3 = oci_execute($stid3);
			$num = oci_fetch_row($stid3);

			if(!$r3)
			{	

			}
			else
			{
    			$s =$num[0] . " " . $num[1] ;
    			array_push($n, $s);
    			//echo $s."<br>";
    			array_push($ma, $num[2]);
    		}
			$stid4 = oci_parse($conn,"drop view a2");
			$stid5 = oci_parse($conn,"drop view b2");
			$r4 = oci_execute($stid4);
			$r5 = oci_execute($stid5);
		}
		echo'<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ["Year - Player Name", "Aces",{ role: "annotation" }],';
         	echo "['".$n[0]." - 2010' , ".$ma[0].", ".$ma[0]."],";
         	echo "['".$n[1]." - 2011' , ".$ma[1].", ".$ma[1]."],";
         	echo "['".$n[2]." - 2012' , ".$ma[2].", ".$ma[2]."],";
         	echo "['".$n[3]." - 2013' , ".$ma[3].", ".$ma[3]."],";
         	echo "['".$n[4]." - 2014' , ".$ma[4].", ".$ma[4]."],";
         	echo "['".$n[5]." - 2015' , ".$ma[5].", ".$ma[5]."],";
         	echo "['".$n[6]." - 2016' , ".$ma[6].", ".$ma[6]."]";
        echo ']);

        var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
        chart.draw(data, {width: 950, height: 700, title: "Maximum Aces in each year"});
      }
    </script>
  </head>

  <body>
    <center><div id="chart_div"></div></center>
  </body>
</html>';
	}
	else if($g == "MDF" && $y!=null)
	{
		$stid1 = oci_parse($conn, "create view a2 as select lid,sum(l_df) as w from loser where tid like '$y%' group by lid having sum(l_df)>0 order by w desc");
		$stid2 = oci_parse($conn,"create view b2 as select wid,sum(w_df) as l from winner where tid like '$y%' group by wid having sum(w_df)>0 order by l desc");
		$stid3 = oci_parse($conn,"select firstname,lastname,c2 from Player,(select * from (select a2.lid as id,(a2.w+b2.l) as c2 from a2,b2 where a2.lid=b2.wid and a2.w+b2.l>0 order by c2 desc) where rownum>0 and rownum<2) where pid=id");
		$r1 = oci_execute($stid1);
		$r2 = oci_execute($stid2);	
		$r3 = oci_execute($stid3);
		$num = oci_fetch_row($stid3);

		if(!$r3)
		{

		}
		else
		{
    		echo "<h3><center>".$num[0] . " " . $num[1] . " has " . $num[2] . " double faults in " . $y. ".</center></h3>" ;
    	}
		$stid4 = oci_parse($conn,"drop view a2");
		$stid5 = oci_parse($conn,"drop view b2");
		$r4 = oci_execute($stid4);
		$r5 = oci_execute($stid5);
	}

	else if($g == "MDF" && $y==null)
	{

	 echo '<script type="text/javascript">',
     'drawChart();',
     '</script>';

		$n = array();
		$ma = array();

		for($x=2010;$x<=2016;$x++)
		{
			$stid1 = oci_parse($conn, "create view a3 as select lid,sum(l_df) as w1 from loser where tid like '$x%' group by lid having sum(l_df)>0 order by w1 desc");
			$stid2 = oci_parse($conn,"create view b3 as select wid,sum(w_df) as l1 from winner where tid like '$x%' group by wid having sum(w_df)>0 order by l1 desc");
			$stid3 = oci_parse($conn,"select firstname,lastname,c2 from player,(select * from (select a3.lid as id,(a3.w1+b3.l1) as c2 from a3,b3 where a3.lid=b3.wid and a3.w1+b3.l1>0 order by c2 desc) where rownum>0 and rownum<2) where pid=id");
			$r1 = oci_execute($stid1);
			$r2 = oci_execute($stid2);
			$r3 = oci_execute($stid3);
			$num = oci_fetch_row($stid3);

			if(!$r3)
			{	

			}
			else
			{
    			$s =$num[0] . " " . $num[1] ;
    			array_push($n, $s);
    			//echo $s."<br>".$num[2]." ".$x;
    			array_push($ma, $num[2]);
    		}
			$stid4 = oci_parse($conn,"drop view a3");
			$stid5 = oci_parse($conn,"drop view b3");
			$r4 = oci_execute($stid4);
			$r5 = oci_execute($stid5);
		}
		echo'<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ["Year - Player Name", "Double Faults",{ role: "annotation" }],';
         	echo "['".$n[0]." - 2010' , ".$ma[0].", ".$ma[0]."],";
         	echo "['".$n[1]." - 2011' , ".$ma[1].", ".$ma[1]."],";
         	echo "['".$n[2]." - 2012' , ".$ma[2].", ".$ma[2]."],";
         	echo "['".$n[3]." - 2013' , ".$ma[3].", ".$ma[3]."],";
         	echo "['".$n[4]." - 2014' , ".$ma[4].", ".$ma[4]."],";
         	echo "['".$n[5]." - 2015' , ".$ma[5].", ".$ma[5]."],";
         	echo "['".$n[6]." - 2016' , ".$ma[6].", ".$ma[6]."]";
        echo ']);

        var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
        chart.draw(data, {width: 950, height: 700, title: "Maximum Double faults in each year"});
      }
    </script>
  </head>

  <body>
    <center><div id="chart_div"></div></center>
  </body>
</html>';
	}
	else if($g == "MWP")
	{
		echo "<script>
		window.location.href='//localhost/testing/max_winning_percent.php';
		</script>";

	}
	else if($g == "CS")
	{
		echo "<script>
		window.location.href='//localhost/testing/career_slams_php.php';
		</script>";

	}
	else if($g == "LSMY" && $y!=null)
	{
		$stid = oci_parse($conn,"select tname,t1,m1,f1,l1,k1 from tournament, (select tid as t1,mid as m1,firstname as f1,lastname as l1, m1 as k1 from player, (select tid,mid,wid as win, lid as lin, minutes as m1 from tournament_match where minutes in (select max(minutes) as longest_match from tournament_match where tid like '$y%') and tid like '$y%') where win=pid or lin=pid) where tournament.tid=t1");
	$stid1 = oci_parse($conn,"select tname,t1,m1,f1,l1,k1 from tournament, (select tid as t1,mid as m1,firstname as f1,lastname as l1, m1 as k1 from player, (select tid,mid,wid as win, lid as lin, minutes as m1 from tournament_match where minutes in (select min(minutes) as longest_match from tournament_match where tid like '$y%' and minutes>0) and tid like '$y%') where win=pid or lin=pid) where tournament.tid=t1");

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
			$arr = explode ("\-", $num1[1]);
			echo "<h3><center>";
			echo " In " . $num1[0] . " " . $arr[0] . ", " . " ".$num1[3] . "  " . $num1[4] . "  vs "  .$num2[3] . " " . 
			$num2[4] ." took " . $num2[5] . " minutes.</center></h3> <br> ";
			echo"<br>";
		}
		
		if($r1)
		{
			$num1 = oci_fetch_row($stid1);
			$num2 = oci_fetch_row($stid1);
			$arr1 = explode ("\-", $num1[1]);
			echo "<h3><center>";
			echo " In " . $num1[0] . " " . $arr1[0] . ", " . " ".$num1[3] . "  " . $num1[4] . "  vs "  .$num2[3] . " " . 
			$num2[4] ." took " . $num2[5] . " minutes.</center></h3>";
		}
    }
}
	
    else if($g == "LSMY" && $y==null)
	{
		echo "<script>
		alert('Year is mandatory');
		window.location.href='//localhost/testing/InterestingFacts.php';

		</script>";
	}
	else if($g == "LGSF")
	{
		echo "<script>
		window.location.href='//localhost/testing/longest_grand_slam_final_php.php';
		</script>";

	}
	else if($g == "LGSM")
	{
		echo "<script>
		window.location.href='//localhost/testing/longest_grand_slam_php.php';
		</script>";

	}

	else if($g == "MNMP")
	{
		echo "<script>
		window.location.href='//localhost/testing/Max_matches_php.php';
		</script>";

	}
	else if($g == "WS")
	{
		$f = $_GET['f'];
		$l = $_GET['l'];
		//$x = $f." ".$l;
		$st = oci_parse($conn,"select pid from player where firstname='$f' and lastname='$l'");
		$r4 = oci_execute($st);
		$num1 = oci_fetch_row($st);
		$p = $num1[0];
		//echo $p;
		$stid1 = oci_parse($conn,"create view daterating as select rating as r1, rdate as rd from rating where pid = '$p' order by RD asc");
		$stid2 = oci_parse($conn,"create view hello as select count(*) as rank, rating.RDATE from rating, daterating where rating>= daterating.r1 and daterating.rd = rdate group by rdate");
	//$stid4 = oci_parse($conn,"create view minRank as select min(rank) as minimunRank from (select * from hello order by rdate asc)");
	
		$stid3 = oci_parse($conn,"select count(rdate) from hello where rank=1");
		$r1 = oci_execute($stid1);
		$r2 = oci_execute($stid2);
		$r3 = oci_execute($stid3);

		if(!$r3)
		{

		}
		else
		{
			$num = oci_fetch_row($stid3);
    		echo "<center><h3>".$f."  " . $l. " has spent " . $num[0] ." weeks at World Number One.</h3></center>" ;
    	}
		$stid4 = oci_parse($conn,"drop view daterating");
		$stid5 = oci_parse($conn,"drop view hello");
		$r4 = oci_execute($stid4);
		$r5 = oci_execute($stid5);
	}
	else if($g=='MS' && $y!=null)
	{
		$stid = oci_parse($conn,"create view w_1 as select tournament.tid as T1,tournament.tdate as D1,tournament_match.wid as W1,tournament_match.lid as L1 from tournament,tournament_match where tournament.tid = tournament_match.tid and 
		tournament.year = '$y' order by tournament.tdate asc");
		$r = oci_execute($stid);

		$stid2 = oci_parse($conn,"select W1 from w_1 having count(W1) > 5 group by W1 order by count(W1) desc");
		$r2 = oci_execute($stid2);

	
		$max=0;
		$pid = 0;
		while ($row1 = oci_fetch_row($stid2))
		{
			//echo $row1[0]." ** ";
		$stid7 = oci_parse($conn,"select W1 from (select W1,rownum from w_1 where W1 = '$row1[0]' or L1 = '$row1[0]') order by rownum asc");
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
	$st = oci_parse($conn,"select firstname,lastname from player where pid='$pid'");
	$r4 = oci_execute($st);
	$num90 = oci_fetch_row($st);
	echo "<h3><center>";
	echo " In " . $y . " , " . $num90[0]." ".$num90[1] . " has maximum winning streak of " . $max .".</center></h3> <br> ";
			echo"<br>";

	$stid5 = oci_parse($conn,"drop view w_1");
	$r5 = oci_execute($stid5);

	}
	else if($g=='MS' && $y==null)
	{
		echo "<script>
		alert('Year is mandatory');
		window.location.href='//localhost/testing/InterestingFacts.php';
		</script>";
	}
}
?>