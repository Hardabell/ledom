  <?php
session_start();
  if (!isset($_SESSION["nama"]))
   {
      header("location: loginPage.php");
   }
   else{
	   $value = $_SESSION["nama"];
   }

include("config.php");

if( !isset($_GET['idContent']) ){
  // kalau tidak ada id di query string
  header('Location: tabelPeserta.php');
}

//ambil id dari query string
$id = $_GET['idContent'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM peserta WHERE no_peserta=$id";
$query = mysqli_query($db, $sql);
$ada = mysqli_fetch_assoc($query);

$sql2 = "SELECT * FROM nilai WHERE no_peserta=$id";
$query2 = mysqli_query($db, $sql2);
$siswa = mysqli_fetch_assoc($query2);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
  die("data tidak ditemukan...");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MeYou - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- Membatasi jumlah karakter-->
	<script type="text/javascript" src="js/jquery-1.4.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#desSingkat').keyup(function() {
	var len = this.value.length;
	if (len >= 250) {
	this.value = this.value.substring(0, 150);
	}
	$('#hitung').text(250 - len);
	});
	});
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
				<li class="active">Add Peserta</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $ada['nama_peserta'] ?></h1>
			</div>
		</div><!--/.row-->			
	<?php
	if( mysqli_num_rows($query2) < 1 ){
		?>
		<form action="prosesAddNilai.php" method="POST" enctype="multipart/form-data">
		<!-- <div class="col-md-6"> -->
				<div class="panel panel-default ">					
					<div class="panel-body timeline-container">
						<!-- <form role="form" method="post" action="toFrom.php"> -->
								<input type="hidden" name="id" value="<?php echo $id ?>">
								<div class="form-group">
									<label>Introduce</label>
									<input name="introduce" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Nilai Introduce" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Kecocokan Busana</label>
									<input name="busana" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Nilai Kecocokan Busana"  data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Catwalk</label>
									<input name="catwalk" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Nilai Catwalk"  data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Ekspresi Wajah</label>
									<input name="wajah" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Nilai Ekspresi Wajah"  data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Keberanian Tampil</label>
									<input name="berani" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Nilai Keberanian Tampil"  data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>QnA</label>
									<input name="qna" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Nilai QnA"  data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Bakat</label>
									<input name="bakat" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Nilai Bakat"  data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div style="text-align: center;">
									<input type="submit" name="btnAdd" value="Submit" class="btn btn-md btn-primary">
								</div>
						<!-- </form> -->
					</div>
				</div>
			<!-- </div> -->
			<!--/.col-->
	</form>
		<?php
}
else{
	?>		
	<form action="prosesModifNilai.php" method="POST" enctype="multipart/form-data">
		<!-- <div class="col-md-6"> -->
				<div class="panel panel-default ">					
					<div class="panel-body timeline-container">
						<!-- <form role="form" method="post" action="toFrom.php"> -->
								<input type="hidden" name="id" value="<?php echo $ada['no_peserta'] ?>">
								<div class="form-group">
									<label>Introduce</label>
									<input name="introduce" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Jumlah Total Donasi" value="<?php echo $siswa['introduce'] ?>" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Kecocokan Busana</label>
									<input name="busana" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Jumlah Total Donasi" value="<?php echo $siswa['kecocokan_busana'] ?>" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Catwalk</label>
									<input name="catwalk" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Jumlah Total Donasi" value="<?php echo $siswa['catwalk'] ?>" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Ekspresi Wajah</label>
									<input name="wajah" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Jumlah Total Donasi" value="<?php echo $siswa['ekspresi_wajah'] ?>" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Keberanian Tampil</label>
									<input name="berani" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Jumlah Total Donasi" value="<?php echo $siswa['keberanian_tampil'] ?>" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>QnA</label>
									<input name="qna" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Jumlah Total Donasi" value="<?php echo $siswa['qna'] ?>" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div class="form-group">
									<label>Bakat</label>
									<input name="bakat" class="form-control" onkeypress="return Angkasaja(event)" placeholder="Jumlah Total Donasi" value="<?php echo $siswa['bakat'] ?>" data-rule="required" data-msg="Jumlah donasi tidak boleh kosong">
								</div>
								<div style="text-align: center;">
									<input type="submit" name="btnModif" value="Update" class="btn btn-md btn-primary">
								</div>
						<!-- </form> -->
					</div>
				</div>
			<!-- </div> -->
			<!--/.col-->
	</form>
			<?php
}
			?>

			<div class="col-sm-12">
				<p class="back-link">Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/scriptku.js"></script>

	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
	

	<script type="text/javascript">
		function Angkasaja(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
		}
	</script>	
</body>
</html>