<?php
  // We need to use sessions, so you should always start sessions using the below code.
  session_start();

  // If the user is logged in and they are not a admin.
  if (isset($_SESSION['loggedin']) && !$_SESSION['admin'])
  {
    header('Location: /assets/php/attack_home.php');
  }

  // If the user is logged in and they are a admin.
  else if (isset($_SESSION['loggedin']) && $_SESSION['admin'])
  {
    header('Location: /assets/php/admin_home.php');
  }

  //exit();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Turtle Stress</title>
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <div class="mainPanel">
      <div>
        <img id="turtle" src="assets/img/turtlestress.png" alt="Turtle stress icon">
        <h1 id="mainHeader">Login</h1>
      </div>

      <form action="assets/php/authenticate.php" method="post">
        <label for="username">
          <i class="fas fa-user"></i>
        </label>
        <input class="textBox" type="text" name="username" placeholder="Username" required>

        <br>
        <br>

        <label for="password">
          <i class="fas fa-lock"></i>
        </label>
        <input class="textBox" type="password" name="password" placeholder="Password" required>

        <br>

        <input class="submitButton" type="submit" name="sub" value="Login">
      </form>
    </div>
  </body>
</html>
