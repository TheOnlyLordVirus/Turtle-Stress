<?php
  // Start a new session.
  session_start();

  if(!isset($_SESSION['loggedin']))
  {
    header('Location: ../../index.html');
    exit();
  }

  $host = "localhost";
  $database = "USER_INFO_DB";
  $user = "root";
  $password = "MyPassWord";

  $connection = mysqli_connect($host, $user, $password, $database);

  // If we throw an error.
  if(mysqli_connect_errno())
  {
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
  }

  // Return IP log.
  $sql_result = $connection->query("select * from STORED_IP");
  if($sql_result->num_rows > 0)
  {
    echo "<tr><th>User Name</th><th>IP Address</th><th>Date Signed In</th></tr>";
    while($row = $sql_result->fetch_assoc())
    {
      echo  '<tr class="ipRow"><td class="UserTxT">' . $row["USER_NAME"] . '</td><td class="IPTxT">' . $row["LOGGED_IP"] . '</td><td class="DataTxT">'. $row["LOGGIN_DATE"] . '</td></tr>';
    }
  }

  else
  {
    die ("Failed to return IP log.");
  }
?>
