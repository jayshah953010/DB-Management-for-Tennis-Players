<?php
// Start the session
session_start();
?>

<?php
$u="jsshah";
$p="Yash!12081997";
$db="oracle.cise.ufl.edu/orcl";
$conn = oci_connect($u,$p,$db);

if(!$conn) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    session_start();
    session_destroy();
}
else
{
echo'
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome to Tennis Geeks</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css" title="style" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body style="">         
<div class="divclass">
<br><br>
 <font face="Segoe Script"><h2 style="font-size:50pt; color:white;"><b><center>Welcome to Tennis Geeks...</b></font></center></h2>
 
 <br><br>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a href="dashboard.php"><button type="button" class="btn btn-primary dropdown-toggle bigFont" style="font-size : 16px; font-weight:bold;">DashBoard </button></a>
        </div>
        <div class="btn-group" role="group">
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle bigFont"style="font-size : 16px; font-weight:bold;">Search <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li class="btn-group btn-group-justified" style="font-size : 16px; font-weight:bold;"><a href="player.php">Player</a></li>
                <li class="btn-group btn-group-justified"  style="font-size : 16px; font-weight:bold;"><a href="Dynamic_dropdown.php">Match Statistics</a></li>
            </ul>
        </div>
  <div class="btn-group" role="group">
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle bigFont" style="font-size : 16px; font-weight:bold;">Trend <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li class="btn-group btn-group-justified"  style="font-size : 16px; font-weight:bold;"><a href="HeadToHead.php">Head To Head</a></li>
                <li class="btn-group btn-group-justified"  style="font-size : 16px; font-weight:bold;"><a href="PA.php">Performance Analysis</a></li>
                <li class="btn-group btn-group-justified"  style="font-size : 16px; font-weight:bold;"><a href="Prediction.php">Prediction</a></li>
            </ul>
        </div>
  <div class="btn-group" role="group">
            <a href="SortedOrder.php"><button type="button" class="btn btn-primary dropdown-toggle bigFont" style="font-size : 16px; font-weight:bold;">Sorted Order</button></a>
         
        </div>
        <div class="btn-group" role="group">
            <a href="InterestingFacts.php"><button type="button" class="btn btn-primary dropdown-toggle bigFont" style="font-size : 16px; font-weight:bold;">Interesting Facts
            </button></a>
         
        </div>
        <div class="btn-group" role="group">
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle bigFont" style="font-size : 16px; font-weight:bold;">Welcome ';
            echo $_SESSION['user'];
echo '<span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li class="btn-group btn-group-justified"  style="font-size : 16px; font-weight:bold;"><a href="Logout.php">Logout</a></li>
            </ul>
        </div>
</div>
</div>
<br><br>
</body>
</html>';
}
?>                              