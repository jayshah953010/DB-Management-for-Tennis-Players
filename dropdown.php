<?php

// Connects to the XE service (i.e. database) on the "localhost" machine
$u="rao";
$p="Pratham123";
$db="oracle.cise.ufl.edu/orcl";
$conn = oci_connect($u,$p,$db);

if(!$conn) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else
{
	$stid = oci_parse($conn, "SELECT * FROM player");
	$r = oci_execute($stid);
	
    $i=1;
	echo "<select id='mycountry'  name='country' class='user'>";
	while($num = oci_fetch_array($stid)) 
	{ 
        echo "<option value='".$num[1]."'>".$i." ".$num[1]." ".$num[2]."</option>";
        $i++;
    }
   // echo "</select>";
}
?>