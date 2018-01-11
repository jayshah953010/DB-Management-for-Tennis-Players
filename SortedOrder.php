<!DOCTYPE html>
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
<body>

<div class="half">
<h3>Sorted Order</h3>
<div class="borderedclass">
  <form name="myForm" method="GET" action="Sorted.php" >
    
    <label class="left" for="gen">Choose Criteria </label>
    <select class="right" id="cri" name="chose">
  <option value="" selected data-default>Select</option>
      <option value="R">Rankings</option>
      <option value="MM">Most Number of Matches Played</option>
      <option value="GS">Grand Slam Titles Won</option>
      <option value="TW">Titles Won</option>
      <option value="PGS">Particular Grand Slams Won</option>
    </select>
  
  <label class="left" for="gen">Choose Tournament</label>
  <select class="right" id="tour" name="chose1">
   
   <option value="" selected data-default>Select</option>
      <option value="US Open">US Open</option>
      <option value="Australian Open">Australian Open</option>
      <option value="Roland Garros">Roland Garros</option>
      <option value="Wimbledon">Wimbledon</option>
    </select>
    <br>
    <br>
    <input type="submit" value="Submit">
  </form>
</div>
</div>
<script type="text/javascript">

   document.getElementById("cri").onchange = function () {
  if(document.getElementById("cri").value != 'PGS')
  {
   document.getElementById("tour").disabled=true;
  }
  else
 {
      document.getElementById("tour").disabled=false;
 }  
  
  
};


</script>
</body>
</html>