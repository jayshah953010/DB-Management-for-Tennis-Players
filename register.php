<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="style.css" title="style" />
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  <script>
function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    var y = document.forms["myForm"]["lname"].value;
    var a = document.forms["myForm"]["pwd1"].value;
    var b = document.forms["myForm"]["pwd2"].value;
    var c = document.forms["myForm"]["username"].value;
    if(x=="" || y=="")
    {
        alert("First Name and Last Name must be filled out.");
        return false;
    }
    if(c=="" || a=="" || b=="")
    {
        alert("Username and Password must be filled out.");
        return false;
    }
    if(a!=b)
    {
        alert("Password mismatch.");
        return false;
    }
}
</script>
</head>
<body>
<div class="half">
<h3>Register</h3>
<div class="borderedclass">
  <form name="myForm" method="GET" action="register_php.php" onsubmit="return validateForm()">
    <label class = "left">First Name</label>
    <input class="right" type="text" name="fname" placeholder="First Name">
    <br>
    <label class = "left">Last Name</label>
    <input class="right" type="text" name="lname" placeholder="Last Name">
    <br>
    <label class = "left">Country </label>
    <input class="right" type="text" name="country" placeholder="Country">
    <br>
    <label class="left" for="gen">Gender </label>
    <select class="right" id="gen" name="gender">
      <option value="f">Female</option>
      <option value="m">Male</option>
      <option value="o">Other</option>
    </select>
    <br>
    <label class="left" for="gen">Birthdate</label>
    <input class="right" type="text" name="dob" id="datepicker" placeholder="BirthDate">
    <br>
    <label class = "left">Email *</label>
    <input class="right" type="text" name="email" placeholder="Email">
    <br>
    <label class = "left">Password *</label>
    <input class="right" type="password" name="pwd1" placeholder="Password">
    <br>
    <label class = "left">Re-enter Password *</label>
    <input class="right" type="password" name="pwd2" placeholder="Password">
    <br>

    
    
    <br>
    <input type="submit" value="Register">
  </form>
</div>
Already a User?<a href="login.php">Login</a>
</div>

</body>
</html>
