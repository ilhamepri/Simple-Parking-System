<?php
include("koneksi.php");
	if (isset($_SESSION ['Login'])){			
?>
<html>
  <head>
    <link rel="shortcut icon" href="img/favicon.ico">

    <title>Home</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />    
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
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
                  <li class="active">
                      <a class="" href="#">
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
              <!--overview start-->
				<div class="row">
					<div class="col-lg-12">
						<h3 class="page-header"><i class="fa fa-laptop"></i> Area</h3>
						<ol class="breadcrumb">
							<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
							<li><i class="fa fa-laptop"></i>Area</li>						  	
						</ol>
					</div>
				</div>
			
			    <!--tab nav start-->
                <section class="panel">
                    <header class="panel-heading tab-bg-primary ">
                        <ul class="nav nav-tabs">
						<?php
						$lantai=mysql_query("select nama_lantai from lantai");
						$fl1=mysql_fetch_array($lantai);
						$fl2=mysql_fetch_array($lantai);
						?>
                            <li class="active">
                                <a data-toggle="tab" href="#lantai1">
								<?php echo $fl1[0];
								?></a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#lantai2">
								<?php echo $fl2[0];
								?></a>
                            </li>
                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div id="lantai1" class="tab-pane active">								
											<div class="panel-body">
												<div class="row">
												<?php
												$sql=mysql_query("select no_area,id_jenis_ken from area where id_lantai='lt01'");
												if( mysql_num_rows($sql) > 0 ){
												while(list($noarea,$idjenisken)=mysql_fetch_array($sql)) {
													$warna='green';
													$tombol='';
												?>
												<div class="cole-lg-3 col-md-3 col-sm-12 col-xs-12">
													<?php
													$sql2=mysql_query("SELECT ka.no_area from karcis ka,pembayaran p where ka.id_karcis=p.id_karcis and ka.no_area='$noarea' and p.status='belum'");
													list($noareaada)=mysql_fetch_array($sql2);
														if ($noarea==$noareaada)
														{
															$warna='red';
															$tombol='disabled';
														}
														else
														{
															$warna='green';
															$tombol='';
														}
													
													?>
															<div class="info-box <?php echo $warna; ?>-bg">
															<h2 align='center'>
															<?php
															echo $noarea;
															?></h2>
															<a href="./formmasuk.php?noarea=<?php echo $noarea; ?>&kend=<?php echo $idjenisken; ?>" class="btn btn-default btn-xs btn-block <?php echo $tombol; ?>">Pilih</a>
														</div>
												</div>
												<?php 
												}
												}
												?>
													
												</div>
											</div>
												<h2><strong></strong></h2>
												<div class="panel-actions">
													<a href="index.php?update" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
												</div>
                            </div>
                            <div id="lantai2" class="tab-pane">
											<div class="panel-body">
												<div class="row">
												<?php
												$sql=mysql_query("select no_area,id_jenis_ken from area where id_lantai='lt02'");
												if( mysql_num_rows($sql) > 0 ){
												while(list($noarea,$idjenisken)=mysql_fetch_array($sql)) {
													$warna='green';
													$tombol='';
												?>
												<div class="cole2-lg-3 col-md-3 col-sm-12 col-xs-12">
												<?php
													$sql2=mysql_query("SELECT ka.no_area from karcis ka,pembayaran p where ka.id_karcis=p.id_karcis and ka.no_area='$noarea' and p.status='belum'");
													list($noareaada)=mysql_fetch_array($sql2);
														if ($noarea==$noareaada)
														{
															$warna='red';
															$tombol='disabled';
														}
														else
														{
															$warna='green';
															$tombol='';
														}
													
													?>
															<div class="info-box <?php echo $warna; ?>-bg">
															<h3 align='center'>
															<?php
															echo $noarea;
															?></h3>
															<a href="./formmasuk.php?noarea=<?php echo $noarea; ?>&kend=<?php echo $idjenisken; ?>" class="btn btn-default btn-xs btn-block <?php echo $tombol; ?>">Pilih</a>
														</div>
												</div>
												<?php
												}
												}
												?>
													
												</div>
											</div>
												<h2><strong></strong></h2>
												<div class="panel-actions">
													<a href="index.php?update" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
												</div>
								
							</div>
						</section>
						<!--tab nav end-->
					</div>
				</div>
                <!--overview start-->
            </section>
		</section>
      <!--main content end-->
  </section>
  <!-- container section start -->

    <!-- javascripts -->
    <script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="js/owl.carousel.js" ></script>
    <!-- custom script for this page-->
	<script src="js/morris.min.js"></script>
	<script src="js/charts.js"></script>
    <script src="js/scripts.js"></script> 
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});



  </script>

  </body>
</html>

<?php 
} 

else{
	header("Location: index.php");
}
	
?>

