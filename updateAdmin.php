<?php
session_start();
  if (!isset($_SESSION["nama"]))
   {
      header("location: loginPage.php");
   }
   else{
	   $value = $_SESSION["nama"];
	   // include database connection file
$connect=mysqli_connect("localhost", "root", "","ledom");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
    $id = $_POST['id'];

    $nama=$_POST['nama'];
    $username=$_POST['username'];
    $email=$_POST['email'];
	$telp=$_POST['telp'];
	$password=$_POST['password'];

    // update user data
	$result = mysqli_query($connect, "UPDATE account SET nama_admin='$nama',emai_admin='$email',password='$password' WHERE id_admin=$id");

    // Redirect to homepage to display updated user in list
    header("Location: signupPage.php");
}
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($connect, "SELECT * FROM account WHERE id_admin=$id");
$user_data = mysqli_fetch_array($result);
   }
?>
<html>
<head>
      <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MeYou - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript">
function delete_data(id)
{
 if(confirm('Sure To Remove This Record ?'))
 {
  window.location.href='deleteAdmin.php?id='+id;
 }
}
</script>
</head>

<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>MeYou</span>Admin</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $value;?></div>
				<!-- <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div> -->
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<!-- <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
		<li ><a href="tabelKriteria.php"><em class="fa fa-bar-chart">&nbsp;</em>Kriteria</a></li>
			<li ><a href="tabelPeserta.php"><em class="fa fa-bar-chart">&nbsp;</em>Peserta</a></li>
			<li><a href="rank.php"><em class="fa fa-dashboard">&nbsp;</em>Ranking</a></li>
			<li class="active"><a href="signupPage.php"><em class="fa fa-user">&nbsp;</em> Admin</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Admin</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Admin</h1>
			</div>
		</div><!--/.row-->
		<div class="col-md-6">
		<form role="form" method="post" action="updateAdmin.php">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<?php echo "<input type='text' name='nama' value= '".$user_data['nama_admin']."' placeholder='nama lengkap' ng-model='registerData.nama' class='form-control' autofocus=''/>"?>
									<!--<input type="text" value=<?php echo $user_data['nama'];?> placeholder="nama lengkap" name="nama" ng-model="registerData.nama" class="form-control" autofocus=""/>-->
								</div>
								<div class="form-group">
									<label>email</label>
									<input type="text" value=<?php echo $user_data['emai_admin'];?> placeholder="email" name="email" ng-model="registerData.email" class="form-control" autofocus=""/>
								</div>
								<div style="text-align: center;">
									<input type="hidden" name="id" value=<?php echo $user_data['id_admin'];?>>
									<input type="hidden" name="password" value=<?php echo $user_data['password'];?>>
									<input type="submit" name="update" class="btn btn-primary" value="update" />
								</div>
						</form>
		
				</div>
	<div class="col-sm-12">
				<p class="back-link">Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
			</div>
  </div>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
