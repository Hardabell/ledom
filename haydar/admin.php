<?php
require './connect.php';

session_start();
if($_SESSION['nama_admin']=='')
{
    header("location:./login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sistem Pendukung keputusan pemilihan Model</title>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="asset/plugin/font-icon/css/fontawesome-all.min.css">

   
   <!--  <style>
body {
    background-color: #000000;
}
</style> -->
</head>
<body>
<header>
  
</header>
<nav class="navbar navbar-default navbar-fixed-top">

    <?php include "nav.php"; ?>
</nav>
<main>
    <div id="main-body">
        <?php include "page.php"; ?>
    </div>
</main>
<script src="asset/js/jquery.js" type="text/javascript"></script>
<script src="asset/js/main.js" type="text/javascript"></script>
</body>
</html>