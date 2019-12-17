<?php

//index.php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MeYou Admin - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row" ng-app="login_register_app" ng-controller="login_register_controller">
	<?php
		if(!isset($_SESSION["nama"]))
		{
	?>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
				<div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg">
					<a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
					{{alertMessage}}
				</div>
				<div ng-show="login_form">
					<form role="form" method="post" ng-submit="submitLogin()">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="email"  ng-model="loginData.username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" ng-model="loginData.password" type="password" value="">
							</div>
							<input type="submit" name="login" class="btn btn-primary" value="Login" /></fieldset>
					</form>
				</div>
				</div>
			</div>
		</div><!-- /.col-->
		<?php
		}
		else
		{
			header("location:tabelPeserta.php");
		}
		?>
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<script>
var app = angular.module('login_register_app', []);
app.controller('login_register_controller', function($scope, $http){
 $scope.closeMsg = function(){
  $scope.alertMsg = false;
 };

 $scope.login_form = true;

 $scope.showLogin = function(){
  $scope.register_form = false;
  $scope.login_form = true;
  $scope.alertMsg = false;
 };

 $scope.submitLogin = function(){
  $http({
   method:"POST",
   url:"login.php",
   data:$scope.loginData
  }).success(function(data){
   if(data.error != '')
   {
    $scope.alertMsg = true;
    $scope.alertClass = 'alert-danger';
    $scope.alertMessage = data.error;
   }
   else
   {
    location.reload();
   }
  });
 };

});
</script>