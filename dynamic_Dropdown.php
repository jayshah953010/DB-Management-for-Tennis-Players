<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" title="style" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript"> 
function fetch_select(val) 
{ 
	//alert(val);
	$.ajax(
	{ 
		type: 'POST', 
		data: 
		{ 
			get_option:val 
		}, 
		url: 'fetch_data.php', 
		cache :false,
		
		success: function (response) 
		{
		 document.getElementById("new_select").innerHTML=response; 
		} 
	}); 
}
function fetch_select1(val) 
{ 
	var selectBox = document.getElementById('selectBox');
   	var selectedValue = selectBox.options[selectBox.selectedIndex].value

	$.ajax(
	{ 
		type: 'POST', 
		data: 
		{ 
			get_option:val,
			get_option1 : selectedValue
		}, 
		url: 'fetch_data1.php', 
		cache :false,
		
		success: function (response) 
		{
		 document.getElementById("new_select1").innerHTML=response; 
		} 
	}); 
}
</script>
</head>
<body>
<?php include'FINAL_HEADER.php';?>

<div class="half">
<h3>Statistics</h3>
<div class="borderedclass">
<form name="myForm" method="GET" action="match.php">
<label class="left" for="gen">Year</label>
 <select class="right" id='selectBox' name='year' onchange='fetch_select(this.value);'>
  <option selected=''>-</option>
  <option value='2000'>2000</option>
  <option value='2001'>2001</option>
  <option value='2002'>2002</option>
  <option value='2003'>2003</option>
  <option value='2004'>2004</option>
  <option value='2005'>2005</option>
  <option value='2006'>2006</option>
  <option value='2007'>2007</option>
  <option value='2008'>2008</option>
  <option value='2009'>2009</option>
  <option value='2010'>2010</option>
  <option value='2011'>2011</option>
  <option value='2012'>2012</option>
  <option value='2013'>2013</option>
  <option value='2014'>2014</option>
  <option value='2015'>2015</option>
  <option value='2016'>2016</option>
</select> 
<br>
<label class="left" for="gen">Tournament</label>
<select class="right" id="new_select" name='tour' onchange='fetch_select1(this.value);'><option selected=''>-</option></select>
<br>
<label class="left" for="gen">Match</label>
<select class="right" id="new_select1" name='match'><option selected=''>-</option></select>
<br>
<br>
<br>
<br>
<br>
<input type="submit" value="Submit">
</form>
</div>
</div>
</body>

</html>
