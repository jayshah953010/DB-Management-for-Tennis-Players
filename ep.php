
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
  </head>
<body>
<?php include 'FINAL_HEADER.php';?> 
<div class="half">
<h3>Add Players </h3>
<div class="borderedclass">
  <form name="myForm" method="GET" action="ep_php.php">
    <label class = "left">Player 1 Name </label>
    <input class="right" type="text" name="p1name" placeholder="Name">
    <br>
    <label class = "left">Player 2 Name </label>
    <input class="right" type="text" name="p2name" placeholder="Name">
    <br>

    <label class = "left">Player 3 Name </label>
    <input class="right" type="text" name="p3name" placeholder="Name">
    <br>
    
    <input type="submit" value="Submit">
  </form>
</div>
</div>
</body>
</html>