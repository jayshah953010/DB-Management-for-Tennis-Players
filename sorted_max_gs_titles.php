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
	$stid = oci_parse($conn,"select firstname,lastname,c1,pid from player ,(select * from (select * from (select champion as ch,count(*) as c1 from tournament where tname='US Open' or tname='Australian Open' or tname='Roland Garros' or tname='Wimbledon' group by champion) order by c1 desc) where rownum<21) where pid=ch");
	$r = oci_execute($stid);
	
		$i=1;
		print '<html><head><link rel="stylesheet" type="text/css" href="style.css" title="style" /></head><body><center>
		<h3><b>Sorted Order for Grand Slam Titles</b></h3><table border="1"> <tbody class="table-hover">';
		print '<tr><td class="text-left" >'. " <b>SrNo " .'</td><td class="text-left">'. " <b>First name".'</td>'.'<td class="text-left">'." <b> Last name ".'</td>'.'<td class="text-left">' . " <b>Titles won </b> ".'</td></tr>';
		
		while ($row = oci_fetch_row($stid))
		{
   			print '<tr>';
   			print '<td class="text-left">'.$i.'</td>';
			print '<td class="text-left">'.$row[0].'</a></td>';
			print '<td class="text-left">'.$row[1].'</a></td>';
       		print '<td class="text-left"><a href="GSBreakDown.php?pid='.$row[3].'">'.$row[2].'</a></td>';
       
   			$i++;
   			print '</tr>';
		}
		print '</table></center><br></body></html>';
}
?>
