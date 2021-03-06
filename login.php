<!DOCTYPE html>
<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
input,select
{
    width: 40%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid black;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 65%;
    background-color:#428cf4;
    color: white;
    padding: 14px 20px;
    margin:20px 55px 10px 110px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    border-radius: 4px;

}

input[type=submit]:hover {
    background-color: #80ccff;
    border-radius: 4px;

}

.borderedclass
{
    border-radius: 5px;
    padding: 20px;

}

.half
{
    width: 50%;
    margin: 100px auto;
    text-align : center;
    background-color: #f2f2f2;
    padding: 20px;
    border: 2px solid black;
    border-radius: 4px;
}

.left {
    margin-top:3%;
    width: 20%;
    float: left;
    text-align: right;
}

.right {
    width: 65%;
    margin-left: 10px;
    float:left;
}

</style>

<head>
<script>
function validateForm() {
    var x = document.forms["myForm"]["username"].value;
    var y = document.forms["myForm"]["pwd"].value;
    if(x=="" && y=="")
    {
    	alert("Username and Password must be filled out.");
        return false;
    }
    if (x == "") 
    {
        alert("Username must be filled out.");
        return false;
    }
    
    if (y == "") 
    {
        alert("Password must be filled out.");
        return false;
    }
}
</script>
</head>

<body>
<div class="half">
<h3>Log In</h3>
<div class="borderedclass">
  <form name="myForm" method="GET" action="login_php.php" onsubmit="return validateForm()">
    <label class = "left">Username *</label>
    <input class="right" type="text" name="username" placeholder="Username">
    <br>
    <label class = "left">Password *</label>
    <input class="right" type="password" name="password" placeholder="Password">
    <br>
    <a class="right" href="fpwd.php">Forgot Password?</a>
    <br>
    <input type="submit" value="Log In">
  </form>
</div>
Not a User?<a href="register.php">Register</a>
</div>

</body>
</html>
