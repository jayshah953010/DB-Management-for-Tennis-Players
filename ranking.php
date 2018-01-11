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
	$stid = oci_parse($conn,"select rownum,firstname,lastname from player,(select pid as p from (select pid from rating where rdate in (select rdate from (select pid,rdate from rating order by rdate desc) where rownum<2) order by rating desc) where rownum<21) where pid=p");
	$r1 = oci_execute($stid);

	if(!$r1)
	{

	}
	else
	{
		$i=1;
		print '<html><head><link rel="stylesheet" type="text/css" href="style.css" title="style" /></head><body><center>
		<h3><b>Ranking</b></h3><table border="1"> <tbody class="table-hover">';
		print '<tr><td class="text-left" >'. " <b>Rank " .'</td><td class="text-left">'. " <b>First name".'</td>'.'<td class="text-left">'." <b> Last name ".'</td></tr>';

		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
   			print '<tr><p>';
  			 foreach ($row as $item) 
   			{

       			print '<td class="text-left">'.($item).'</td>';
       
   			}
   			$i++;
   			print '</p></tr>';
		}
		print '</table></center><br></body></html>';
	}
}

?>