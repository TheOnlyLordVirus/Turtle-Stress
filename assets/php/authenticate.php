<?php
  session_start();

  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = 'MyPassWord';
  $DATABASE_NAME = 'USER_INFO_DB';

  // Try and connect using the info above.
  $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
  if (mysqli_connect_errno()/*If the last sqli attempt returned an error*/)
  {
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
  }

  // Now we check if the data from the login form was submitted, isset() will check if the data exists.
  if (!isset($_POST['username'], $_POST['password']) )
  {
    // Could not get the data that should have been sent.
    die ('Please fill both the username and password field!');
  }

  // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
  /*
  Prepared statements reduce parsing time as the preparation on the query is done only once (although the statement is executed multiple times)
  Bound parameters minimize bandwidth to the server as you need send only the parameters each time, and not the whole query
  Prepared statements are very useful against SQL injections, because parameter values, which are transmitted later using a different protocol, need not be correctly escaped. If the original statement template is not derived from external input, SQL injection cannot occur.
  */
  if ($stmt = $con->prepare('SELECT USER_ID, USER_PASS, IS_ADMIN FROM USER WHERE USER_NAME = ?'))
  {
  	// Bind parameter '?' (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
  	$stmt->bind_param('s', $_POST['username']);

    // Exexute the sql query.
  	$stmt->execute();

  	// Store the result so we can check if the account exists in the database.
  	$stmt->store_result();
  }

  // Did this username exist?
  if ($stmt->num_rows > 0)
  {
    // Bind the results to variables then fetch them.
  	$stmt->bind_result($id, $password, $admin);
  	$stmt->fetch();

  	// Account exists, now we verify the password.
  	// Note: remember to use password_hash in your registration file to store the hashed passwords.
  	if ($_POST['password'] === $password/*password_verify($_POST['password'], $password)*/)
    {
  		// Verification success! User has loggedin!
  		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
  		session_regenerate_id();
  		$_SESSION['loggedin'] = TRUE;
  		$_SESSION['name'] = $_POST['username'];
  		$_SESSION['id'] = $id;
      $_SESSION['admin'] = $admin;
      $ip = getUserIpAddr();

      // Log current IP.
      if ($stmt2 = $con->prepare("call logIP(?, ?)"))
      {
        // Bind parameter '?' (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt2->bind_param('is', $id, $ip);

        // Exexute the sql query.
        $stmt2->execute();

        // Go to attack_home.php
        if(!$admin)
        {
      		header('Location: attack_home.php');
        }

        else
        {
          header('Location: admin_home.php');
        }

      }

      else
      {
        session_destroy();
        die ('Failed to log ip address.');
      }
  	}

    else
    {
  		header('Location: ../html/password-error.html');
  	}
  }

  else
  {
  	header('Location: ../html/user-error.html');
  }

  $stmt->close();
  $stmt2->close();

  // Gets a users IP address.
  function getUserIpAddr()
  {
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
  }
?>
