<?php
session_start();
  if (!isset($_SESSION["nama"]))
   {
       header("location: loginPage.php");
   }
   else{
	   $value = $_SESSION["nama"];
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
		<div ng-app="login_register_app" ng-controller="login_register_controller">
		<div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg" align="center">
				<a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
				{{alertMessage}}
			</div>
			<div class="col-md-6" ng-show="register_form">
						<form role="form" method="post" ng-submit="submitRegister()">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" placeholder="nama lengkap" name="nama" ng-model="registerData.nama" class="form-control" autofocus=""/>
								</div>
								<div class="form-group">
									<label>email</label>
									<input type="text" placeholder="email" name="email" ng-model="registerData.email" class="form-control" autofocus=""/>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" placeholder="password" name="password" ng-model="registerData.password" class="form-control" value="" />
								</div>
								<div style="text-align: center;">
									<input type="submit" name="register" class="btn btn-primary" value="Register" />
									<br>
									<a href="signupPage.php">View All</a>
								</div>
						</form>
			</div>
		<div ng-show="table_admin">
		<input type="button" name="table_link" class="btn btn-primary" ng-click="showRegister()" value="Register" />
		<br>
		<br>
		<div style="overflow-x:auto;">
					<table id="tabel-data" class="table-bordered">
						<thead>
							<tr>
								<th>Nama</th>
								<th>email</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
								<?php
								$connect=mysqli_connect("localhost", "root", "","ledom");
								$sql = "SELECT * FROM account ORDER BY id_admin DESC";
								$query = mysqli_query($connect, $sql);
											
								while($row = mysqli_fetch_array($query)){
								 echo "<tr>";
        echo "<td>".$row['nama_admin']."</td>";  
		echo "<td>".$row['emai_admin']."</td>";
		echo "<td> <a href='javascript:delete_data($row[id_admin])'>Delete</a>|<a href='updateAdmin.php?id=$row[id_admin]'>Edit</a></td></tr>"; 
								}		
								?>
						</tbody>

						<script>
						$(document).ready(function(){
							$('#tabel-data').DataTable();
						});
						</script>
				</table>
				</div>
				</div>
				</div>
	<div class="col-sm-12">
				<p class="back-link">Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
			</div>
  </div>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
<script>
var app = angular.module('login_register_app', []);
app.controller('login_register_controller', function($scope, $http){
 $scope.closeMsg = function(){
  $scope.alertMsg = false;
 };

 $scope.table_admin = true;

$scope.showTable = function(){
  $scope.register_form = false;
  $scope.table_admin = true;
  $scope.alertMsg = false;
 };
 
 $scope.showRegister = function(){
  $scope.register_form = true;
  $scope.table_admin = false;
  $scope.alertMsg = false;
 };
 
 $scope.submitRegister = function(){
  $http({
   method:"POST",
   url:"signup.php",
   data:$scope.registerData
  }).success(function(data){
   $scope.alertMsg = true;
   if(data.error != '')
   {
    $scope.alertClass = 'alert-danger';
    $scope.alertMessage = data.error;
   }
   else
   {
    $scope.alertClass = 'alert-success';
    $scope.alertMessage = data.message;
    $scope.registerData = {};
   }
  });
 };


});
</script>