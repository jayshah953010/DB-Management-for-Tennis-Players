<?php 
include 'FINAL_HEADER.php';
?>

<html>
<head>
    <link href="1/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="1/js-image-slider.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.js"></script> 
    <link href="generic.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript"> 
    function fetch_select() 
	{
		//alert("HI");
	$.ajax(
	{  
		url: "data.php", 
		cache :false,
		
		success: function (response) 
		{
		 document.getElementById("new_select").innerHTML=response; 
		} 
	}); 
	}
	</script>
</head>

<body>
	<div id="sliderFrame">
		<div id="slider">
		<img src="images/federer.jpg" />
		
		<img src="images/stan.jpg"/>
		<img src="images/filis.jpg" />
		<img src="images/alex.jpg" />
		<img src="images/djokovik.jpg" />
		</div><div id="htmlcaption" style="display: none;">
		</div></div><br><br><br>
		<center><table id="new_select"></table></center>
		<br><br>
		<center><button type="button" class="btn btn-danger" onClick="fetch_select();">Click Me For more Info on Databases</button></center>
	<br>
	<br>
    
</body>
</html>';

