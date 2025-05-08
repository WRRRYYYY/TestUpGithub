<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php //if(!$SessionEmpty) { ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php 
	$RupiahHariIni = 0;
	$TransferHariIni = 0;		
	$RupiahSDHariIni = 0;	
	$Persentase = 0;

	$Month01 = 1;
	$Month02 = 2;
	$Month03 = 3;
	$Month04 = 4;
	$Month05 = 5;
	$Month06 = 6;

	$Proyeksi01 = 0;
	$Proyeksi02 = 0;
	$Proyeksi03 = 0;
	$Proyeksi04 = 0;
	$Proyeksi05 = 0;
	$Proyeksi06 = 0;

	$Bayar01 = 0;
	$Bayar02 = 0;
	$Bayar03 = 0;
	$Bayar04 = 0;
	$Bayar05 = 0;
	$Bayar06 = 0;
	
	if(isset($oQueryList)) {
		if(count($oQueryList) > 0) {
			foreach($oQueryList as $oRS) {
				$RupiahHariIni = $oRS->RupiahHariIni;
				$TransferHariIni = $oRS->TransferHariIni;
				$RupiahSDHariIni = $oRS->RupiahSDHariIni;		
				$Persentase = $oRS->Persentase;	

				$Month01 = $oRS->Month01;	
				$Month02 = $oRS->Month02;	
				$Month03 = $oRS->Month03;	
				$Month04 = $oRS->Month04;	
				$Month05 = $oRS->Month05;	
				$Month06 = $oRS->Month06;	

				$Proyeksi01 = $oRS->Proyeksi01;	
				$Proyeksi02 = $oRS->Proyeksi02;	
				$Proyeksi03 = $oRS->Proyeksi03;	
				$Proyeksi04 = $oRS->Proyeksi04;	
				$Proyeksi05 = $oRS->Proyeksi05;	
				$Proyeksi06 = $oRS->Proyeksi06;	

				$Bayar01 = $oRS->Bayar01;	
				$Bayar02 = $oRS->Bayar02;	
				$Bayar03 = $oRS->Bayar03;	
				$Bayar04 = $oRS->Bayar04;	
				$Bayar05 = $oRS->Bayar05;	
				$Bayar06 = $oRS->Bayar06;	
			}
		}
	}

?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo number_format($TransferHariIni,0) ?></h3>

                <p>Transfer hari ini</p>
              </div>
              <div class="icon">
                <!--<i class="ion ion-android-phone-portrait"></i>-->
                <i class="fas fa-credit-card"></i>
              </div>
<?php 
				$hash = hash('sha512',rand());
				$pos = substr(rand(),0,1); 
				$mnu = $pos . substr($hash,0,128-intval($pos)) . "0901" . substr($hash,-1*intval($pos));
?>
              <a href="<?php echo base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu ?>/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo number_format($RupiahHariIni/1000,0) ?><sup style="font-size: 20px">k</sup></h3>

                <p>Rupiah hari ini</p>
              </div>
              <div class="icon">
                <!--<i class="ion ion-wallet"></i>-->
                <i class="fas fa-coins"></i>
              </div>
<?php 
				$hash = hash('sha512',rand());
				$pos = substr(rand(),0,1); 
				$mnu = $pos . substr($hash,0,128-intval($pos)) . "0902" . substr($hash,-1*intval($pos));
?>
              <a href="<?php echo base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu ?>/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo number_format($RupiahSDHariIni/1000,0,",",".") ?><sup style="font-size: 20px">k</sup></h3>

                <p>Rupiah s/d hari ini</p>
              </div>
              <div class="icon">
                <!--<i class="ion ion-ios-calculator-outline"></i>-->
                <i class="fas fa-calculator"></i>
              </div>
<?php 
				$hash = hash('sha512',rand());
				$pos = substr(rand(),0,1); 
				$mnu = $pos . substr($hash,0,128-intval($pos)) . "0903" . substr($hash,-1*intval($pos));
?>
              <a href="<?php echo base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu ?>/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo number_format($Persentase,2,",",".") ?><sup style="font-size: 20px">%</sup></h3>

                <p>Rupiah s/d hari ini vs Proyeksi</p>
              </div>
              <div class="icon">
                <!--<i class="ion ion-pie-graph"></i>-->
                <i class="fas fa-percent"></i>
              </div>
<?php 
				$hash = hash('sha512',rand());
				$pos = substr(rand(),0,1); 
				$mnu = $pos . substr($hash,0,128-intval($pos)) . "0907" . substr($hash,-1*intval($pos));
?>
              <a href="<?php echo base_url() . "/" . strtolower($controller_name)."/mnu/" . substr(md5(rand()),4,7) . "/salt/" . $mnu ?>/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <div class="row">
        <div class="col-sm-12" style="padding:15px">
            <!-- Custom tabs (Charts with tabs)-->
          	<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-line mr-1"></i>
                  Proyeksi vs Penerimaan Semester <?php echo $AppClass->NamaPeriodeAktif; ?></h3>

                <div class="card-tools" style="display:none">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  <table id="datagrafik" style="display:none">
                  	<tr>
                    	<td><?php echo $AppClass->arBulan[$Month01] ?></td>
                    	<td><?php echo $Proyeksi01 ?></td>
                    	<td><?php if($Bayar01==0 && date("m")==$Month01) { echo $RupiahSDHariIni; } else { echo $Bayar01; } ?></td>
                    	<td><?php 
							if($Proyeksi06<=0) echo "0";
							else {
								if($Bayar01==0 && date("m")==$Month01) { 
									echo 100*$RupiahSDHariIni/$Proyeksi06; 
								} else { echo 100*$Bayar01/$Proyeksi06; }
							} ?></td>
                  	</tr>
                  	<tr>
                    	<td><?php echo $AppClass->arBulan[$Month02] ?></td>
                    	<td><?php echo $Proyeksi02 ?></td>
                    	<td><?php if($Bayar02==0 && date("m")==$Month02) { echo $RupiahSDHariIni; } else { echo $Bayar02; } ?></td>
                    	<td><?php 
							if($Proyeksi06<=0) echo "0";
							else {
								if($Bayar02==0 && date("m")==$Month02) { 
									echo 100*$RupiahSDHariIni/$Proyeksi06; 
								} else { echo 100*$Bayar02/$Proyeksi06; }
							} ?></td>
                  	</tr>
                  	<tr>
                    	<td><?php echo $AppClass->arBulan[$Month03] ?></td>
                    	<td><?php echo $Proyeksi03 ?></td>
                    	<td><?php if($Bayar03==0 && date("m")==$Month03) { echo $RupiahSDHariIni; } else { echo $Bayar03; } ?></td>
                    	<td><?php 
							if($Proyeksi06<=0) echo "0";
							else {
								if($Bayar03==0 && date("m")==$Month03) { 
									echo 100*$RupiahSDHariIni/$Proyeksi06; 
								} else { echo 100*$Bayar03/$Proyeksi06; }
							} ?></td>
                  	</tr>
                  	<tr>
                    	<td><?php echo $AppClass->arBulan[$Month04] ?></td>
                    	<td><?php echo $Proyeksi04 ?></td>
                    	<td><?php if($Bayar04==0 && date("m")==$Month04) { echo $RupiahSDHariIni; } else { echo $Bayar04; } ?></td>
                    	<td><?php 
							if($Proyeksi06<=0) echo "0";
							else {
								if($Bayar04==0 && date("m")==$Month04) { 
									echo 100*$RupiahSDHariIni/$Proyeksi06; 
								} else { echo 100*$Bayar04/$Proyeksi06; }
							} ?></td>
                  	</tr>
                  	<tr>
                    	<td><?php echo $AppClass->arBulan[$Month05] ?></td>
                    	<td><?php echo $Proyeksi05 ?></td>
                    	<td><?php if($Bayar05==0 && date("m")==$Month05) { echo $RupiahSDHariIni; } else { echo $Bayar05; } ?></td>
                    	<td><?php 
							if($Proyeksi06<=0) echo "0";
							else {
								if($Bayar05==0 && date("m")==$Month05) { 
									echo 100*$RupiahSDHariIni/$Proyeksi06; 
								} else { echo 100*$Bayar05/$Proyeksi06; }
							} ?></td>
                  	</tr>
                  	<tr>
                    	<td><?php echo $AppClass->arBulan[$Month06] ?></td>
                    	<td><?php echo $Proyeksi06 ?></td>
                    	<td><?php if($Bayar06==0 && date("m")<=$Month06) { echo $RupiahSDHariIni; } else { echo $Bayar06; } ?></td>
                    	<td><?php 
							if($Proyeksi06<=0) echo "0";
							else {
								if($Bayar06==0 && date("m")<=$Month06) { 
									echo 100*$RupiahSDHariIni/$Proyeksi06; 
								} else { echo 100*$Bayar06/$Proyeksi06; }
							} ?></td>
                  	</tr>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.Left col -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php //} else { echo $html_SessionEmpty; } ?>
<?= $this->endSection() ?>