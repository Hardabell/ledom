<?php
session_start();
  if (!isset($_SESSION["email"]))
   {
      header("location: loginPage.php");
   }
   else{
	   $value = $_SESSION["email"];
	   echo $value;
   }
?>