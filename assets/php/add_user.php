<?php
  // We need to use sessions, so you should always start sessions using the below code.
  session_start();

  // If the user is not logged in redirect to the login page...
  // So basicly we are storing php variables in the users session,
  // then we use these in orde to stop the user from being able to gain access to the logged in side of things.
  if (!isset($_SESSION['loggedin']) || !$_SESSION['admin'])
  {
    header('Location: index.html');
    exit();
  }

  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = 'Kush007';
  $DATABASE_NAME = 'USER_INFO_DB';

  // Try and connect using the info above.
  $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
  if (mysqli_connect_errno()/*If the last sqli attempt returned an error*/)
  {
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
  }

  // Now we check if the data from the create user form was submitted, isset() will check if the data exists in the post array.
  if (!isset($_POST['username'], $_POST['password']))
  {
    // Could not get the data that should have been sent.
    die ('Post input error! Contact LordVirus#4698 on discord.');
  }

  // Checkbox bool.
  if(isset($_POST['admin']))
  {
    $bool = 1;
  }

  else
  {
    $bool = 0;
  }

  // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
  /*
  Prepared statements reduce parsing time as the preparation on the query is done only once (although the statement is executed multiple times)
  Bound parameters minimize bandwidth to the server as you need send only the parameters each time, and not the whole query
  Prepared statements are very useful against SQL injections, because parameter values, which are transmitted later using a different protocol, need not be correctly escaped. If the original statement template is not derived from external input, SQL injection cannot occur.
  */
  if ($stmt = $con->prepare('call addUser(?, ?, ?)'))
  {
  	// Bind parameter '?' (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
  	$stmt->bind_param('ssi', strtolower($_POST['username']), $_POST['password'], $bool);

    // Exexute the sql query.
  	$stmt->execute();

  	// Store the result so we can check if the account exists in the database.
  	$stmt->store_result();
  }

  header('Location: admin_home.php');
?>
