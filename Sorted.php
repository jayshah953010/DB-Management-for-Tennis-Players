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
	if(isset($_GET['chose1']))
		$y=$_GET['chose1'];
	else
		$y=null;

	if($g == "R")
	{
		echo "<script>
		window.location.href='//localhost/testing/ranking.php';
		</script>";
	}
	if($g == "MM")
	{
		echo "<script>
		window.location.href='//localhost/testing/sorted_most_matches.php';
		</script>";
	}
	else if($g == "GS")
	{
		echo "<script>
		window.location.href='//localhost/testing/sorted_max_gs_titles.php';
		</script>";

	}
	else if($g == "TW")
	{
		echo "<script>
		window.location.href='//localhost/testing/sorted_max_titles.php';
		</script>";
	}
	else if($g == "PGS")
	{
		//echo $y;
		$stid = oci_parse($conn,"select pid,firstname,lastname,c1 from player ,(select * from 
	(select * from (select champion as ch,count(*) as c1 from tournament where tname='$y' group by champion) order by c1 desc) where rownum<21) where pid=ch");
	$r = oci_execute($stid);
			
	if(!$r)
	{

	}
	else
	{
		$i=1;
		print '<html><head><link rel="stylesheet" type="text/css" href="style.css" title="style" /></head><body><center>
		<h3><b>Sorted Order for most number of ' . $y . ' Titles</b></h3><table border="1"> <tbody class="table-hover">';
		print '<tr class="trclass"><td class="text-left" >'. " <b>SrNo " .'</td><td class="text-left">'. " <b>First name".'</td>'.'<td class="text-left">'." <b> Last name ".'</td>'.'<td class="text-left">' . " <b>Titles won </b> ".'</td>'.'<td class="text-left">' . " <b>Year </b> ".'</td></tr>';
		
		while ($row = oci_fetch_row($stid)) 
		{
			$h = array();
		$stid11 = oci_parse($conn,"select * from (select champion as ch,year as y1 from tournament where tname='$y') order by ch,y1");
			$r11 = oci_execute($stid11);
   			print '<tr class="trclass">';
   			print '<td class="text-left">'.$i.'</td>';
  			print '<td class="text-left">'.$row[1].'</td>';
			print '<td class="text-left">'.$row[2].'</td>';
			print '<td class="text-left">'.$row[3].'</td>';
			
			while($row1 = oci_fetch_row($stid11))
			{
				if($row[0] == $row1[0])
				{
					array_push($h,$row1[1]);
				}
			}
			print '<td class="text-left">';
			print implode(" , ",$h);
			print '</td>';
         			$i++;
   			print '</tr>';
		}
		print '</table></center><br></body></html>';
	}
	}
}
?>