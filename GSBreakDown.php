<?php include 'FINAL_HEADER.php';?>
<?php
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
	$f= $_GET['pid'];
	//echo $f;

	$stid1 = oci_parse($conn, "select firstname,lastname from player where pid='$f'");
	$r1 = oci_execute($stid1);
	$num1 = oci_fetch_row($stid1);

	$stid = oci_parse($conn,"select tname,count(champion) from tournament where tname in ('US Open','Australian Open','Roland Garros','Wimbledon') and CHAMPION = '$f' group by tname order by count(champion) desc");
	$r = oci_execute($stid);
	
	
	

	print '<html><head><link rel="stylesheet" type="text/css" href="style.css" title="style" /></head><body><center>
		<h3><b>Grand Slam Titles won by '.$num1[0]." ".$num1[1].'</b></h3><table border="1"> <tbody class="table-hover">';
		$i=1;
	
	while($row = oci_fetch_row($stid))
	{
		$stid11 = oci_parse($conn,"select tname,year from tournament where tname in ('US Open','Australian Open',
		'Roland Garros','Wimbledon') and CHAMPION = '$f'  order by tname,year");
	$r11 = oci_execute($stid11);
		$y=array();
		print '<tr>';
   		print '<td class="text-left">'.$i.'</td>';
		print '<td class="text-left">'.$row[0].'</td>';
		while($row1 = oci_fetch_row($stid11))
		{
			if($row1[0] == $row[0] )
			{
				
				array_push($y,$row1[1]);
			}
		}
		
		print '<td class="text-left">'.$row[1].'</td>';
		print '<td class="text-left">';
		print implode(" , ",$y);
		print '</td>';
		
   		print '</tr>';
		
   		$i++;
	}
	
	print '</table></center><br></body></html>';
}
?>