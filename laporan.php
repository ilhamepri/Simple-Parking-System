<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
include("koneksi.php");
	if (isset($_SESSION ['Login'])){
?>
<html>
  <head>
    <link rel="shortcut icon" href="img/favicon.ico">
    <title>Laporan</title>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
		<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
		<script src="https://cdnjs.com/libraries/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo">Parking <span class="lite">System</span></a>
            <!--logo end-->
            <div class="top-nav notification-row">
               <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/user.png">
                            </span>
                            <span class="username"><?php echo $_SESSION['Login'];?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li>
                                <a href="logout.php"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li>
                      <a class="" href="index.php">
                          <i class="icon_house_alt"></i>
                          <span>Area</span>
                      </a>
                  </li>
				  <li>
					  <a class="">
                          <i class="icon_document_alt"></i>
                          <span>Kendaraan Masuk</span>
                      </a>
				  </li>
				  <li class="">
					  <a class="" href="formkeluar.php">
                          <i class="icon_document_alt"></i>
                          <span>Kendaraan Keluar</span>
                      </a>
				  </li>
                  <li class="active">
                      <a class="" href="#">
                          <i class="icon_piechart"></i>
                          <span>Laporan</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
        <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header"><i class="icon_piechart"></i> Laporan</h3>
				<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
					<li><i class="icon_piechart"></i>Laporan</li>
				</ol>
			</div>
		</div>
		<?php
			if(isset($_REQUEST['submit'])){
				$submit = $_REQUEST['submit'];
				$tgl1 = $_REQUEST['tgl1'];
				$tgl2 = $_REQUEST['tgl2'];
				$q = "SELECT * FROM pembayaran WHERE status='sudah' and tanggal BETWEEN '$tgl1' AND '$tgl2' ";
				echo '<div class="row"><div class="col-lg-12"><div class="well well-sm noprint"><h2>Rekap Pembayaran <small>'.$tgl1.' sampai '.$tgl2.'</small></h2><hr></div></div></div>';
			}else {
				$tgl = date("Y-m-d");
				$q = "SELECT * FROM pembayaran WHERE  status='sudah' and tanggal='$tgl'";
				echo '<div class="row"><div class="col-lg-12"><div class="well well-sm noprint"><h2>Rekap Pembayaran <small>'.$tgl.'</small></h2><hr></div></div></div>';
			}
		    $sql = mysql_query($q);
		?>
		<div class="row">
			<div class="col-md-12">
			<div class="well well-sm noprint">
				<form role="form" method="post" action="">
				  <div class="form-group">
					<label for="tgl1">Mulai</label>
					<input type="date" class="form-control" id="tgl1" name="tgl1">
				  </div>
				  <div class="form-group">
					<label for="tgl2">Hingga</label>
					<input type="date" class="form-control" id="tgl2" name="tgl2">
				  </div>
				  <button type="submit" name="submit" class="btn btn-default">Tampilkan</button>
				</form>
			</div>
			</div>
		</div>
	<?php
      echo '<table class="table table-hover">';
      echo '<tr class="info"><th width="50">#</th><th>ID Pembayaran</th><th>ID Karcis</th><th><span class="pull-right">Jumlah</th></tr>';

      $total = 0;
      $no=1;
      while(list($idpembayaran,$idkarcis,$masuk,$keluar,$tanggal,$sewa,$jumlah) = mysql_fetch_array($sql)){
         echo '<tr><td>'.$no.'</td><td>'.$idpembayaran.'</td><td>'.$idkarcis.'</td><td><span class="pull-right">'.$jumlah.'</span></td></tr>';
         $total += $jumlah;
         $no++;
      }
      echo '<tr><td colspan="3"><span><strong>T O T A L</strong></span></td><td><span class="pull-right"><strong>'.$total.'</strong></span></td></tr>';
      echo '</table>';
      echo '</div></div>';
	?>
      </section>
      <!--main content end-->
    </section>
    <!-- container section end -->
		<div class="col-lg-12">
		<div class="ct-chart" id="ct-chart"></div>
	</div>
    <script>
		new Chartist.Line('.ct-chart', {
series: [[
	{x: 1, y: 100},
	{x: 2, y: 50},
	{x: 3, y: 25},
	{x: 5, y: 12.5},
	{x: 8, y: 6.25}
]]
}, {
axisX: {
	type: Chartist.AutoScaleAxis,
	onlyInteger: true
}
});
    </script>
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
	  <!-- javascripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
		<script src="js/scripts.js"></script>
  </body>
</html>
<?php
}
else{
	header("Location: index.php");
}
?>
