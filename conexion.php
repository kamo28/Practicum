<?php
  function OpenCon()
 {
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "WQD4.hUCY3a-8_g";
   $db = "DAW";
   $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
   $conn->set_charset("utf8");

   return $conn;
 }

 function CloseCon($conn)
  {
    $conn -> close();
  }
?>
