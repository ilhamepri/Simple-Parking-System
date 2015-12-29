<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include("koneksi.php");
	if (isset($_SESSION ['Login'])){
?>
<html>
<head>
    <link rel="shortcut icon" href="img/favicon.ico">
    <title>Form Kendaraan Keluar</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
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
				  <li class="active">
					  <a class="" href="#">
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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Kendaraan Keluar</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-files-o"></i>Kendaraan Keluar</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->
			<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Kendaraan Keluar
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-horizontal " method="post" action="" >
                                      <div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">ID karcis <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input pattern=".{14,14}" style="text-transform:uppercase" class=" form-control" id="nostnk" name="nostnk" type="text" required/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                      <label for="address" class="control-label col-lg-2">Denda</label>
                                          <div class="col-lg-10">
                                              <input name="check_list[]" type="checkbox" value="den02"/><label>Denda karcis hilang</label><br>
                                              <input name="check_list[]" type="checkbox" value="den03"/><label>Denda inap</label>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Lihat</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
					  </div>
              </div>
              <!-- page end-->
			  	<?php
					if( isset( $_REQUEST['submit'] )){
				?>
				<div class="row" id="hide" >
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Karcis keluar
                        </header>
                        <div class="panel-body">
                            <form>
								X PLAZA SURABAYA<br><br>
								<?php
								$nostnk=$_POST['nostnk'];
								mysql_query("Update pembayaran set keluar=CURRENT_TIMESTAMP where id_karcis=$nostnk");
								$sql = mysql_query("select * from pembayaran where id_karcis=$nostnk");
								list($idpem,$idkar,$mlebu,$metu,$jml,$stat)=mysql_fetch_array($sql);
								if(!empty($_POST['check_list'])){
								foreach($_POST['check_list'] as $selected){
									$sql = mysql_query("select harga_denda from denda where id_denda='$selected'");
									list($harga_denda)=mysql_fetch_array($sql);
									mysql_query("INSERT INTO detail_pembayaran VALUES ('$selected','$idpem','$harga_denda')");
								}
								}else{
									$sql = mysql_query("select harga_denda from denda where id_denda='den01'");
									list($harga_denda)=mysql_fetch_array($sql);
									mysql_query("INSERT INTO detail_pembayaran VALUES ('den01', '$idpem','$harga_denda')");
								}
									echo "".$nostnk. "<br>" ;
									$masuk= new DateTime("$mlebu");
									$keluar = new DateTime("$metu");
									$interval =  $keluar->diff($masuk);
									if ((($interval->format("%i"))>0)&&(($interval->format("%H"))<1)){
										$sewa=5000;
									}else{
										$sewa=((($interval->format("%H"))*5000)+5000);
									}
									$sql=mysql_query("select sum(denda) from detail_pembayaran where id_pembayaran='$idpem' GROUP by id_pembayaran");
									list($totaldenda)=mysql_fetch_array($sql);
									$totalbayar=($sewa+$totaldenda);
									mysql_query("update pembayaran set sewaparkir='$sewa',total='$totalbayar' where id_pembayaran='$idpem'");
									mysql_query("Update pembayaran set keluar='$metu', status='sudah' where id_karcis=$nostnk");
									$sql=mysql_query("select no_area from karcis where id_karcis=$nostnk");
									list($noarea)=mysql_fetch_array($sql);
								?>
								<table><br>
								<tr><td>In</td><td>:</td><td><?php echo $mlebu ?></td></tr>
								<tr><td>Out</td><td>:</td><td><?php echo $metu ?></td></tr>
								<tr><td>Lama</td><td>:</td><td><?php echo $interval->format("%d hari %H jam %i menit");  ?></td></tr>
								<tr><td>Area</td><td>:</td><td><?php echo $noarea ?></td></tr>
								<tr><td><b>Denda</b></td><td>:</td><td>Rp <?php echo $totaldenda ?> ,-</td></tr>
								<tr><td><b>Sewa Parkir</b></td><td>:</td><td>Rp <?php echo $sewa ?> ,-</td></tr>
								<tr><td></td><td></td><td><u>___________________________+<u></td></tr>
								<tr><td><b>Total</b></td><td>:</td><td>Rp <?php echo $totalbayar ?> ,-</td></tr>
								</table>
								<br>
								<br>
								TERIMA KASIH<br>
								ATAS KUNJUNGAN ANDA
								<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
												<a href='karciskeluar.php?no=<?php echo $nostnk; ?>&in=<?php echo $mlebu; ?>&out=<?php echo $metu; ?>&lama=<?php echo $interval->format("%d hari %H jam %i menit");  ?>&area=<?php echo $noarea ?>&denda=<?php echo $totaldenda ?>&sewa=<?php echo $sewa ?>&total=<?php echo $totalbayar ?>' target='_blank' class="btn btn-primary" name="submit">Cetak</a>
										</div>
								</div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
			<?php
				}
			?>
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
	<script src="js/scripts.js"></script>
  </body>
</html>
<?php
}
else{
	header("Location: index.php");
}
?>
