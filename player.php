<?php include 'FINAL_HEADER.php';?>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="style.css" title="style" />
  <link rel="stylesheet" href="/resources/demos/style.css">
  <body>
<div class="half">
<h3>Player Details</h3>
<div class="borderedclass">
  <form name="myForm" method="GET" action="search_player.php" onsubmit="return validateForm()">
    <label class = "left">First Name </label>
    <input class="right" type="text" name="fname" placeholder="First Name">
    <br>
    <label class = "left">Last Name </label>
    <input class="right" type="text" name="lname" placeholder="First Name">
    <br>
    <br>
    <input type="submit" value="Submit">
  </form>
</div>
</div>
</body>
</html>