<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content="width=device-width, initial-scale = 1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>

<body>

<?php

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: main.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["firstName"] = $_POST["firstName"];
    $_SESSION["lastName"] = $_POST["lastName"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["phoneNumber"] = $_POST["phoneNumber"];

    header("Location: apply2.php");

}
else {
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
			<h1>First Name:</h1>
			<input type="text" name="firstName" maxlength="50"/><br><br>
			
			<h1>Last Name:</h1>
			<input type="text" name="lastName" maxlength = "50"/><br><br>
			
			<h1>Email:</h1>
			<input type="email" name="email"/><br><br>
			
			<h1>Phone Number format (XXX)XXX-XXXX:</h1>
			<input type="text" pattern = "\([0-9]{3}\)[0-9]{3}-[0-9]{4}" name="phoneNumber"/><br><br>
			
			
			<input type="submit" name="nextPageButton" value = "Next"/><br>
			<br>
			<input type = "submit" name = "returnHomeButton" value = "Return to Main Menu"/>
		</form>		
BODY;
}

echo $contactInfo;


?>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>
