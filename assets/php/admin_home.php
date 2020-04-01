<?php
  // We need to use sessions, so you should always start sessions using the below code.
  session_start();

  // If the user is not logged in redirect to the login page...
  // So basicly we are storing php variables in the users session,
  // then we use these in orde to stop the user from being able to gain access to the logged in side of things.
  if (!isset($_SESSION['loggedin']) || !$_SESSION['admin'])
  {
  	header('Location: ../../');
  	exit();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Home</title>
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/tabs.css">
  </head>

  <body>

    <div id="main">
      <div>
        <img id="turtle" src="../img/turtlestress.png" alt="Turtle stress icon">
        <h1 id="mainHeader">Turtle Stresser</h1>
      </div>

     <ul class="myTabs">
       <li>
         <ul>
           <li>
             <h3>Stresser</h3>
           </li>

           <li>
             <h3>Add Users</h3>
           </li>

           <li>
             <h3>IP Logger</h3>
           </li>
         </ul>

         <!-- Web Stresser -->
         <ul>
           <li>
             <div class="tabsPanel">
               <h1>Stress IP</h1>
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
           </li>
         </ul>

         <!-- Add User -->
         <ul>
           <li>
             <div class="tabsPanel">
               <h1>Add User</h1>
               <form id="addUser" action="add_user.php" method="post">
                 <div id="alignContent">
                   <div>
                     <label for="username">
                       <i class="fas fa-user"></i>
                     </label>
                     <input id="username" class="textBox" type="text" name="username" placeholder="Username" required>
                   </div>

                   <br>
                   <br>

                   <div>
                     <label for="password">
                       <i class="fas fa-lock"></i>
                     </label>
                     <input id="password" class="textBox" type="password" name="password" placeholder="Password" required>
                   </div>

                   <br>
                   <br>

                   <div>
                     <label id="isAdmin" for="admin">
                       <i class="fas fa-user-shield"></i>
                       <i class="fa">Is Admin?</i>
                     </label>
                     <input class="checkbox" type="checkbox" name="admin" value="true">
                   </div>
                 </div>

                 <br>

                 <input class="submitButton" type="submit" name="subuser" value="Add user">
               </form>
             </div>
           </li>
         </ul>

         <!-- IP Logger -->
         <ul>
           <li>
             <div class="tabsPanel">
               <h1>IP History</h1>
               <div id="ipLogDiv">
                 <table id="ipLog">
                 </table>
               </div>
             </div>
           </li>
         <ul>
       </li>
     </ul>
   </div>

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/validate-attack.js"></script>
    <script src="../js/validate-user.js"></script>
    <script src="../js/tabs.js"></script>
    <script src="../js/updateIP.js"></script>
    <script src="../js/attackCount.js"></script>
    <script src="../js/subPHP.js"></script>
  </body>
</html>
