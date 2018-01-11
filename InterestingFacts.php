<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" type="text/css" href="style.css" title="style" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>
<body>
<?php include 'FINAL_HEADER.php';?>

<div class="half">
<h3>Interesting Facts</h3>
<div class="borderedclass">
  <form name="myForm" method="GET" action="if.php" onsubmit="return validateForm()">
    
    <label class="left" for="gen">Choose</label>
    <select class="right" id="gen" name="chose">
  <option value="None">None</option>
    <option value="MWP">Maximum Winning Percentage</option>
  <option value="MS">Maximum Winning Streak</option>
       <option value="MA">Maximum Aces</option>
      <option value="MDF">Maximum Double Faults</option>
   <option value="CS">Career Slams</option>
   <option value="LSMY">Longest and Shortest match of the year</option>
   <option value="LGSF">Longest Grand Slam Final</option>
   <option value="LGSM">Longest Grand Slam Match</option>
   <option value="MNMP">Most Number of Matches played</option>
   <option value="WS">Weeks Spent at Number 1</option>
    </select>
    <br>
    <br>
  
    <label class="left" for="gen">Enter the year</label>
    <input class="right" id="year" name="year">
    
    <br>
  <br>
  
    <label class="left" for="gen">Player FName</label>
    <input class="right" id="p1" name="f">
    
    <br>
  <br>
  
    <label class="left" for="gen">Player LName</label>
    <input class="right" id="p2" name="l">
    
    <br>
  
    <input type="submit" value="Submit">
  </form>
</div>
</div>

<script type="text/javascript">

   document.getElementById("gen").onchange = function () {
  if(document.getElementById("gen").value != 'MDF' && document.getElementById("gen").value != 'MA' && document.getElementById("gen").value != 'LSMY' && document.getElementById("gen").value != 'MS' )
  {
   document.getElementById("year").disabled=true;
  }
  else
 {
      document.getElementById("year").disabled=false;
 }  
  
  if(document.getElementById("gen").value != 'WS')
  {
   document.getElementById("p1").disabled=true;
   document.getElementById("p2").disabled=true;
  }
  else
  {
   document.getElementById("p1").disabled=false;
   document.getElementById("p2").disabled=false;
  }
};

   function validateForm() {
    var x = document.forms["myForm"]["year"].value;
  
  var y = parseInt(x);
  
 
    
};

</script>

</script>
</body>
</html>