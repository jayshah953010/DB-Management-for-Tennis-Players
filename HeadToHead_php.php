<?php
 include 'FINAL_HEADER.php';
 echo '<script type="text/javascript">',
     'drawChart();',
     '</script>';
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
	$p1f = $_GET['p1fname'];
	$p2f = $_GET['p2fname'];
	$p1l = $_GET['p1lname'];
	$p2l = $_GET['p2lname'];
	print '<center><table border="1">';
    $stid34 = oci_parse($conn,"select pid from player where firstname='$p2f' and lastname='$p2l'");
    $r34 = oci_execute($stid34);
    $num34 = oci_fetch_row($stid34);
    $stid35 = oci_parse($conn,"select pid from player where firstname='$p1f' and lastname='$p1l'");
    $r35 = oci_execute($stid35);
    $num35 = oci_fetch_row($stid35);

    $stid1 = oci_parse($conn, "select count(*) from tournament_match where wid in (select pid from player where firstname='$p1f' 
        and lastname='$p1l') and lid in (select pid from player where firstname='$p2f' and lastname='$p2l')");
    $r1 = oci_execute($stid1);
    $num1 = oci_fetch_row($stid1);

    $stid2 = oci_parse($conn, "select count(*) from tournament_match where lid in (select pid from player where firstname='$p1f' 
        and lastname='$p1l') and wid in (select pid from player where firstname='$p2f' and lastname='$p2l')");
    $r2 = oci_execute($stid2);
    $num2 = oci_fetch_row($stid2);
    //$num2[0] - nadal is loser
    if($num34[0]!=null && $num35[0]!=null)
    {
        $stid3 = oci_parse($conn, "select surface,count(*)as c from tournament, (select tid as p from tournament_match where 
            lid='$num35[0]' and wid ='$num34[0]') where tournament.tid=p group by surface");
        $r3 = oci_execute($stid3);

        $stid4 = oci_parse($conn, "select surface,count(*)as c from tournament, (select tid as p from tournament_match where 
            lid='$num34[0]' and wid ='$num35[0]') where tournament.tid=p group by surface");
        $r4 = oci_execute($stid4);
        //print '<tr><td><b>Surface</b></td><td><b>'. $p1f . " ". $p1l . "(Wins)". '</b></td><td><b>' . $p2f. " ". $p2l . "(Wins)" . '</b></td></tr>';
        
        $i=0;

        $c = array();
        $c1 = array();
        $c2 =array();
        while($i<3) 
        {
            $row3 = oci_fetch_row($stid3);
            $row4 = oci_fetch_row($stid4);

            array_push($c, $row3[0]);
            array_push($c1, $row3[1]);
            array_push($c2, $row4[1]);
            //echo $row3[1]." ".$row4[1]."<br>";
            $i++;
        }

		print "<html>
  			<head>
    		<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    		<script type='text/javascript'>
      google.charts.load('current', {packages:['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart()
    {
        var data = google.visualization.arrayToDataTable([";
          echo "['Court','".$p1f." ".$p1l."','".$p2f." ".$p2l."'],";
          echo "['".$c[0]."' , ".$c2[0].",".$c1[0]."],";
          echo "['".$c[1]."' , ".$c2[1].",".$c1[1]."],";
          echo "['".$c[2]."' , ".$c2[2].",".$c1[2]."]";
          echo "]);
        var options = {
          chart: {
            title: 'Head to Head',
          },
          hAxis: { title:'Court'},
          vAxis: {title: 'Matches Won'},
          bars: 'vertical'
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id='barchart_material' style='width: 500px; height: 300px;'></div>
  </body>
</html>";
print '<center><br><br><table border="1">';
		$stid100 = oci_parse($conn,"select pid from player where firstname = '$p1f' and lastname = '$p1l'");
		$stid101 = oci_parse($conn,"select pid from player where firstname = '$p2f' and lastname = '$p2l'");
		$ex1 = oci_execute($stid100);
		$ex2 = oci_execute($stid101);

		$pid1 = oci_fetch_row($stid100);
		$pid2 = oci_fetch_row($stid101);

		$stid102 = oci_parse($conn,"select tournament.year, round, tname as tournament, 
		surface, wid as wineer, lid as loser, score from tournament, (select tid as t1, round, score, lid, wid 
		from tournament_match where (lid = '$pid1[0]' and wid = '$pid2[0]') or (lid = '$pid2[0]' and wid = '$pid1[0]')) 
		where t1 = tournament.TID order by year desc");
		print '<tr><td class="text-left" >'. " <b>SrNo " .'</td><td class="text-left">'. " <b>Year".'</td>'.
		'<td class="text-left">'." <b> Round".'</td>'.'<td class="text-left">' . " <b>Tournament </b>".'</td>'.
		'<td class="text-left">' . " <b>Surface </b>".'</td>'.'<td class="text-left">'."<b>Winner </b>".'</td>'.
		'<td class="text-left"><b>Loser </b></td>'.'<td class="text-left">'."<b>Score </b>".'</td></tr>';
		$ex3 = oci_execute($stid102); 
		$i=1;
		while ($row = oci_fetch_array($stid102, OCI_ASSOC+OCI_RETURN_NULLS))
		{
   			print '<tr><td class="text-left">'.$i.'</td>';
   			
  			 foreach ($row as $item) 
   			{
   				if($item==$pid1[0])
   				{
   					print '<td class="text-left">'.$p1f." ".$p1l.'</td>';
   				}
   				else if($item==$pid2[0])
   				{
   					print '<td class="text-left">'.$p2f." ".$p2l.'</td>';
   				}
   				else
   				{
   					print '<td class="text-left">'.($item).'</td>';
   				}
       
   			}
   			$i++;
   			print '</tr>';
		}
		print '</table><br><br>';
	}
	else
	{
		echo "<script>
		alert('Invalid Player Name..');
		window.location.href='//localhost/testing/HeadToHead.php';
		</script>";
	}
}
?>