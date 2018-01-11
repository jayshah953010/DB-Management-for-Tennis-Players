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
	$f = $_GET['fname'];
	$l = $_GET['lname'];

	print '<center><table border="1">';
	$stid1 = oci_parse($conn, "select dob,chirality,country,pid,extract(year from dob) from player where firstname='$f' and lastname='$l'");
	$r1 = oci_execute($stid1);
	$num = oci_fetch_row($stid1);
	if($num[3]!=null)
	{
		$stid2 = oci_parse($conn, "select count(*) from tournament where champion='$num[3]'");
		$r2 = oci_execute($stid2);
		$num2 = oci_fetch_row($stid2);

		$stid3 = oci_parse($conn, "select count(*) as wi from winner where wid='$num[3]'");
		$stid4 = oci_parse($conn, "select count(*) as lo from loser where lid ='$num[3]'");
		$r3 = oci_execute($stid3);
		$r4 = oci_execute($stid4);
		$w = oci_fetch_row($stid3);
		$l9 = oci_fetch_row($stid4);
		$num55 = $w[0]+$l9[0];
		$num66 = $w[0];
		$num5 = ($w[0]/$num55)*100;
		$y = 2016 - $num[4];
		print '<tr><td><b>'."Name".'</b></td><td>' . $f. " ". $l . '</td></tr>';
		print '<tr><td><b>'."Birthdate".'</b></td><td>' . $num[0] . '</td></tr>';
		print '<tr><td><b>'."Age".'</b></td><td>' . $y. '</td></tr>';
		print '<tr><td><b>'."Country".'</b></td><td>' . $num[2] . '</td></tr>';
		if($num[1]=='R')
			$n = "Right-Hand";
		else if($num[1]=='L')
			$n= "Left-Hand";
		else
			$n= "Unknown";
		print '<tr><td><b>'." Plays ".'</b></td><td>'. $n .'</td></tr>';

		$stid17 = oci_parse($conn,"select count(*) from rating, (select rating as x from rating where pid = ".$num[3]." and rdate in (select * from (select rdate from rating order by rdate desc) where rownum < 2)) where rdate in (select * from (select rdate from rating order by rdate desc) where rownum < 2) and rating.rating >= x");
		$r17 = oci_execute($stid17);
		$num17 = oci_fetch_row($stid17);

		print '<tr><td><b>'." Current Ranking ".'</b></td><td>' . $num17[0] . '</td></tr>';

		$stid21 = oci_parse($conn,"create view hello as select count(*) as rank, rating.RDATE from rating, (select rating as r1, rdate as rd from rating where pid = ".$num[3]." order by RD asc) where rating >= r1 and rd = rdate group by rdate");
		$stid41 = oci_parse($conn,"create view minRank as select min(rank) as minimunRank from (select * from hello order by rdate asc)");
		
		$stid31 = oci_parse($conn,"select * from (select rank,rdate from hello, minRank where minimunRank = hello.RANK order by rdate asc) where rownum<2");
		$r21 = oci_execute($stid21);
		$r41 = oci_execute($stid41);
		$r31 = oci_execute($stid31);
		$num31 = oci_fetch_row($stid31);
		print '<tr><td><b>'."Career Best Rank".'</b></td><td>' . $num31[0] . '</td></tr>';
		print '<tr><td><b>'."Number of titles won".'</b></td><td>' . $num2[0] . '</td></tr>';
		print '<tr><td><b>'."Number of matches played".'</b></td><td>' . $num55 . '</td></tr>';
		print '<tr><td><b>'."Number of matches won".'</b></td><td>' . $num66 . '</td></tr>';
		print '<tr><td><b>'."Winning percentage".'</b></td><td>' . round($num5,2). '</td></tr></table></center><br><br>';
		$stid5 = oci_parse($conn,"drop view hello");
		$stid6 = oci_parse($conn,"drop view minRank");
		$r5 = oci_execute($stid5);
		$r6 = oci_execute($stid6);

	  $stid1 = oci_parse($conn, "select pid from player where firstname='$f' and lastname='$l'");
	  $r1 = oci_execute($stid1);
	  $num = oci_fetch_row($stid1);
      $s1 = array();
      for($x=2010;$x<=2016;$x++)
  	  {
	    $stid29 = oci_parse($conn,"create view a1 as select rating as rank1,PID as p1 from rating where EXTRACT(MONTH FROM RDate) = 12 and EXTRACT(DAY FROM RDate) >= 25 and EXTRACT(YEAR from RDate) = '$x' order by rating desc");
	    $r29 = oci_execute($stid29);
	    
	    $stid90 = oci_parse($conn,"select rank1/100 as rank from a1,Player where Player.PID = a1.p1 and Player.FIRSTNAME = '$f' and Player.LASTNAME = '$l'");
	    $r90 = oci_execute($stid90);
	    $num90 = oci_fetch_row($stid90);
    	array_push($s1,$num90[0]);
      $stid49 = oci_parse($conn,"drop view a1");
    	$r49 = oci_execute($stid49);
	   }
	   echo"<html>
  			<head>
    		<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    		<script type='text/javascript'>
      		google.charts.load('current', {'packages':['corechart']});
      		google.charts.setOnLoadCallback(drawChart);

      		function drawChart() 
      		{
        		var data = google.visualization.arrayToDataTable
        		([";
          		echo "['Year','".$f." ".$l."'],";
            	echo "[2010 , ".$s1[0]."],";
            	echo "[2011,  ".$s1[1]."],";
            	echo "[2012,  ".$s1[2]."],";
            	echo "[2013,  ".$s1[3]."],";
            	echo "[2014,  ".$s1[4]."],";
            	echo "[2015,  ".$s1[5]."],";
            	echo "[2016,  ".$s1[6]."],";
          		echo "]);

        		var options = {
          		title: 'Tennis Player Performance',
          		legend: { position: 'right' },
          		hAxis: { title:'Year' , ticks: [2010,2011,2012,2013,2014,2015,2016],format:'####'},
          		vAxis: {title: 'Performance'}  
        		};

       			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

		        chart.draw(data, options);	
      		}
    		</script></head>
			  <body>
			    <center>
			    <div id='curve_chart' style='width: 900px; height: 500px'></div></center><br><br>
			  </body>
			</html>";
	}
	else
	{
		echo "<script>
			alert('Invalid Player name..');
			window.location.href='//localhost/testing/player.php';
			</script>";
	}
}
?>