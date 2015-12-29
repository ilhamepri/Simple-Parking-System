<?php
session_start();
include("koneksi.php");
$no_area=$_REQUEST["noarea"];
$id_kend=$_REQUEST["kend"];
$usern=$_SESSION['Login'];
date_default_timezone_set("Asia/Jakarta");

	if (isset($_SESSION ['Login'])){
?>
<html>
  <head>
    <link rel="shortcut icon" href="img/favicon.ico">

    <title>Form Kendaraan Masuk</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!--external css-->
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
                            <span class="username"><?php echo $usern; ?></span>
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
                      <a class="" href="index.php" disabled>
                          <i class="icon_house_alt"></i>
                          <span>Area</span>
                      </a>
                  </li>
				  <li class="active">
					  <a class="" href="#">
                          <i class="icon_document_alt"></i>
                          <span>Kendaraan Masuk</span>
                      </a>
				  </li>
				  <li>
					  <a class="" href="formkeluar.php">
                          <i class="icon_document_alt"></i>
                          <span>Kendaraan Keluar</span>
                      </a>
				  </li>
                  <li>
                      <a class="" href="laporan.php">
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
					<h3 class="page-header"><i class="fa fa-file-text-o"></i> Kendaraan Masuk</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-file-text-o"></i>Kendaraan Masuk</li>
					</ol>
				</div>
			</div>
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Kendaraan Masuk
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal " method="POST" action="">
									<div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">No.Stnk <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input style="text-transform:uppercase" class="form-control" name="nostnk" type="text" pattern=".{3,8}" required/>
                                          </div>
									</div>

									<div class="form-group">

                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" name="submit" type="submit">Cetak</button>

                                          </div>
                                    </div>
                              </form>

                          </div>

                      </section>

                          </div>

                      </div>

			<?php
				if( isset( $_REQUEST['submit'] )){
			?>
			<div class="row" id="hide" style="display: none;">
                <div class="col-lg-12">
                    <section class="panel">

                        <header class="panel-heading">
                            Karcis masuk
                        </header>
                        <div class="panel-body">
                            <form>
								X PLAZA SURABAYA<br>
								<?php
								$a = "SELECT MAX(id_pembayaran) FROM pembayaran";
								$b = mysql_query($a);
								$c = mysql_fetch_array($b);
								list($maks) = mysql_fetch_row($b);

								$max = $c[0];
								$idang = substr($max, 1, 4);
								$idang = $idang + 1;
								if($idang <= 9) $idhasil = "P000".$idang;
								if($idang <= 99 && $idang >9) $idhasil = "P00".$idang;
								if($idang <= 999 && $idang >99) $idhasil = "P0".$idang;
								if($idang <= 9999 && $idang >999) $idhasil = "P".$idang;

								date_default_timezone_set("Asia/Jakarta");
								$date=date("d-m-Y h:i:s");
								$date3=date("Y-m-d");
								$date2=date("Ymdhis");
								$nostnk=$_REQUEST['nostnk'];


								if(isset($_POST['nostnk']) and(!empty($_POST['nostnk']))) {
									mysql_query("INSERT INTO karcis VALUES ('$date2','$no_area', '$nostnk', CURRENT_TIMESTAMP, '$id_kend', '$usern')");
									mysql_query("INSERT INTO pembayaran values ('$idhasil','$date2',CURRENT_TIMESTAMP,NULL,'$date3',NULL,NULL,'belum')");
								}
									echo "".$nostnk." / " ;

								?>
								<?php
								$hm=mysql_query("select k.id_karcis,k.no_area,k.no_stnk,k.masuk,k.id_jenis_ken,k.user_kar,kn.nama_jenis_ken from karcis k, kendaraan kn where k.id_jenis_ken=kn.id_jenis_ken and k.no_stnk='$nostnk'");
								$data=mysql_fetch_array($hm);
								echo("<META HTTP-EQUIV=\"Refresh\"CONTENT=\"2;URL=karcismasuk.php?noarea=$no_area&namakend=$data[6]&nostnk=$nostnk&idkarcis=$data[0]&user=$data[5]&masuk=$data[3]\">");
								echo "".$data[6]."";
								echo "</br>";
								echo "".$data[0]." / "; echo "".$data[5]."";
								echo "</br>";
								?>
								<table><br>
								<tr><td>In</td><td>:</td><td><?php echo $data[3] ?></td></tr>
								<tr><td>Area</td><td>:</td><td><?php echo $data[1]; ?></td></tr>
								</table>
								<br>
								<br>
								SELAMAT DATANG DI<br>X PLAZA SURABAYA<br>SIMPAN TIKET INI DENGAN AMAN
                            </form>
                        </div>
                    </section>
                </div>
            </div>
			<?php
				}
			?>

                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    <!-- javascripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery ui -->
    <script src="js/jquery-ui-1.10.4.min.js"></script>
	<script src="js/scripts.js"></script>

  </body>
</html>
<?php
}

else{
	header("Location: index.php");
}

?>
