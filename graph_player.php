<?php
include 'FINAL_HEADER.php';
echo '<script type="text/javascript">',
     'drawChart();',
     '</script>';
     
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

      function drawChart() {
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
           // $j++;
          //}
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
    </script>
  </head>
  <body>
    <center>
    <div id='curve_chart' style='width: 900px; height: 500px'></div></center>
  </body>
</html>";
}
?>