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
  $f1 = $_GET['p1fname'];
  $l1 = $_GET['p1lname'];
  $f2 = $_GET['p2fname'];
  $l2 = $_GET['p2lname'];

  $s1 = array();
  $s2 = array();

  for($x=2010;$x<=2016;$x++)
  {

    $stid21 = oci_parse($conn,"create view a1 as select rating as rank1,PID as p1 from rating where EXTRACT(MONTH FROM RDate) = 12 and EXTRACT(DAY FROM RDate) >= 25 and EXTRACT(YEAR from RDate) = $x order by rating desc");
    $r21 = oci_execute($stid21);

    $stid = oci_parse($conn,"select rank1/100 as rank from a1,Player where Player.PID = a1.p1 and Player.FIRSTNAME = '$f1' and Player.LASTNAME = '$l1'");
    $r = oci_execute($stid);
    $num = oci_fetch_row($stid);
    if($num[0]!=null)
    {
      $flag=1;
    
   // echo $num[0]."<br>";
    array_push($s1,$num[0]);

    $stid1 = oci_parse($conn,"select rank1/100 as rank from a1,Player where Player.PID = a1.p1 and Player.FIRSTNAME = '$f2' and Player.LASTNAME = '$l2'");
    $r1 = oci_execute($stid1);
    $num1 = oci_fetch_row($stid1);
    //echo $num1[0]."<br>";
    
    array_push($s2,$num1[0]);
    $stid4 = oci_parse($conn,"drop view a1");
    $r4 = oci_execute($stid4);
  }
}
  //echo $s1[0]."Jay".$s2[0];
  if($num1[0]!=null)
  {
  echo"<html>
  <head>
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable
        ([";
          echo "['Year','".$f1." ".$l1."','".$f2." ".$l2."'],";
            echo "[2010 , ".$s1[0].",".$s2[0]."],";
            echo "[2011,  ".$s1[1]."," .$s2[1]."],";
            echo "[2012,  ".$s1[2]."," .$s2[2]."],";
            echo "[2013,  ".$s1[3]."," .$s2[3]."],";
            echo "[2014,  ".$s1[4]."," .$s2[4]."],";
            echo "[2015,  ".$s1[5]."," .$s2[5]."],";
            echo "[2016,  ".$s1[6]."," .$s2[6]."],";
           // $j++;
          //}
          echo "]);

        var options = {
          title: 'Tennis Player Performance Comparision',
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
else
{
  echo "<script>
    alert('Invalid Player Name');
    window.location.href='//localhost/testing/PA.php';
    </script>";
}
}

?>