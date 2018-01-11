<?php
//Include database configuration file
include 'FINAL_HEADER.php';
$u="jsshah";
$p="Yash!12081997";
$db="oracle.cise.ufl.edu/orcl";
$conn = oci_connect($u,$p,$db);
echo 'Bansari';

if(!$conn) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else
{
	if(isset($_GET['year_id']) && !empty($_GET['year_id']))
	{
		$r = $_GET['year_id'];
	
		$stid = oci_parse($conn,"select tname FROM tournament where tid like '$r%' ");
		$r = oci_execute($stid);
	
		if(!$r)
		{

		}
		else
		{
			$i=1;
			echo '<label class="left" for="gen">Tournament</label>';
			echo "<select class='right' id='tournament'>";
		
			while($num = oci_fetch_array($stid)) 
			{	 
       	 		echo "<option value='".$num[0]."'>".$num[0]."</option>";
    		}
		}
	}
	else
	{
		echo "else";
	}
}
?>