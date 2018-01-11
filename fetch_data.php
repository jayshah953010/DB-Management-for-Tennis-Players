<?php
//if(isset($_POST['get_option']))
//{
	$u="jsshah";
	$p="Yash!12081997";
	$db="oracle.cise.ufl.edu/orcl";
	$conn = oci_connect($u,$p,$db);
	//include 'FINAL_HEADER.php';

	if(!$conn) 
	{
    	$e = oci_error();
    	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	else
	{
		if(isset($_POST['get_option']))
 		{
 			$f = $_POST['get_option'];
 			$stid = oci_parse($conn, "select tname FROM tournament where tid like '$f%'");
			$r = oci_execute($stid);
			echo "<select class='right' name='tour'>";
			echo "<option value=''>-</option>";
			while($num = oci_fetch_row($stid)) 
			{	 
       	 		echo "<option value='".$num[0]."'>".$num[0]."</option>";
    		}

    		echo "</select>";
 		}
 	}
?>