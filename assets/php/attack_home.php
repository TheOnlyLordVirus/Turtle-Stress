<?php
  // We need to use sessions, so you should always start sessions using the below code.
  session_start();

  // If the user is not logged in redirect to the login page...
  // So basicly we are storing php variables in the users session,
  // then we use these in orde to stop the user from being able to gain access to the logged in side of things.
  if (!isset($_SESSION['loggedin']))
  {
  	header('Location: ../../');
  	exit();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Turtle Stress</title>
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>

  <body>
    <div class="mainPanel">
      <div>
        <img id="turtle" src="../img/turtlestress.png" alt="Turtle stress icon">
        <h1 id="mainHeader">Turtle Stresser</h1>
      </div>
      <form id="mainForm">
        <div>
          <label for="ip">
            <i class="fas fa-wifi"></i>
          </label>
          <input class="textBox" id="ip" type="text" name="ip" placeholder="0.0.0.0" required>
        </div>

        <br>
        <br>

        <div>
          <label for="port">
            <i class="fas fa-network-wired"></i>
          </label>
          <input class="textBox" id="port" type="text" name="port" placeholder="80" required>
        </div>

        <br>
        <br>

        <div>
          <label for="dur">
            <i class="fas fa-stopwatch"></i>
          </label>
          <input class="textBox" id="dur" type="text" name="dur" placeholder="300 (Seconds)" required>
        </div>

        <br>

        <div>
          <p id="attackCount"></p>
        </div>

        <br>

        <input id="submitAttack" type="submit" name="sub" value="Simulate Attack">
      </form>

      <form action="logout.php" method="post">
        <input class="submitButton" type="submit" name="logout" value="Logout">
      </form>
    </div>

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/validate-attack.js"></script>
    <script src="../js/attackCount.js"></script>
    <script src="../js/subPHP.js"></script>
  </body>
</html>
