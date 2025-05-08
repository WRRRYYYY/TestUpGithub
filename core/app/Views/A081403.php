<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1><?php echo $NamaMenu ?></h1>
          </div>
          <div class="col-sm-6 d-none">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Administrasi</li>
              <li class="breadcrumb-item active"><?php echo $NamaMenu ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div id="card-header" class="card-header">
          <div class="card-title" style="white-space:nowrap">
            <form id="page_form" class="form-inline">
              <select id="Periode" name="Periode" class="form-control form-control-sm select2 float-left" style="width:120px;" required="required" placeholder="Pilih Tahun">
                <?php
                if (isset($oQueryPeriode)) {
                  if (count($oQueryPeriode) > 0) {
                    foreach ($oQueryPeriode as $oRS) { ?>
                      <option value="<?php echo $oRS->Kode ?>" <?php if ($periode == $oRS->Kode) { ?> selected="selected" <?php } ?>><?php echo $oRS->Nama ?></option>
                <?php
                    }
                  }
                } ?>
              </select>
              <button name="reload" class="btn btn-sm btn-success control-reload float-left" style="margin-left:2px" type="button"><i class="fa fa-sync-alt"></i></button>
              <!--<strong><?php echo $Today ?></strong>-->
              <button name="new" class="btn btn-sm btn-primary control-new float-left d-none" style="margin-left:2px" type="button"><i class="fa fa-plus"></i><span class="hidden-xs-down">&nbsp;&nbsp;New</span></button>
            </form>
          </div>

          <div class="card-tools">
            <div class="action-pad box-tools" style="display:none">
              <div class="float-right">
                <a type="button" class="btn btn-sm control-edit" href="#edit"><i class="fas fa-edit"></i></a>
                <button type="button" class="btn btn-sm control-edit font-18" disabled="disabled" style="display:none"><i class="fas fa-edit"></i></button>
                <a type="button" class="btn btn-sm control-del" href="#hapus"><i class="fas fa-trash"></i></a>
              </div>
            </div>
          </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="datatable" class="table table-striped">
            <thead>
              <tr>
                
                <th>No Reg</th>
                <th>Tanggal Reg</th>
                <th>Kepada</th>
                <th>Perihal</th>
                <!-- <th>Posisi Terakhir</th> -->
                <th class="text-center">Aksi</th>

              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($oQueryList)) {
                if (count($oQueryList) > 0) {
                  foreach ($oQueryList as $oRS) {
                    $hash = hash('sha512', rand());
                    $pos = substr(rand(), 0, 1);
                    $mnu = $pos . substr($hash, 0, 128 - intval($pos)) . $AppClass->KodeMenu . substr($hash, -1 * intval($pos));
                    $url_add = "/frm/cod" . $oRS->idx . "/";
              ?>
                    <tr>
                      
                      <td><?php echo $oRS->RegNo ?></td>
                      <td><?php echo $oRS->RegTanggal ?></td>
                      <td><?php echo $oRS->Kepada ?></td>
                      <td><?php echo $oRS->Perihal ?></td>
                      <!-- <td><span class="badge badge-warning" ><?php //echo $oRS->PosisiTerakhir  ?></span></td> -->
                      <td class="text-center" style="width:40px">
                        <div class="btn-group" role="group" aria-label="Action Button">
                          <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu . $url_add ?>" class="btn btn-xs btn-info control-view" title="Buka Form <?php echo $NamaMenu ?>"><i class="fas fa-edit small"></i></a>
                        </div>
                      </td>
                    </tr><?php
                        }
                      }
                    } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">Form Kirim Notifikasi Whatsapp</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Isi form di sini -->
            <form id="fonnteForm">
              <div class="form-group">
                <label for="target">Target</label>

                <select name="target" id="target" class="select2 form-control" multiple="multiple" data-placeholder="Pilih target Yang Bertugas" style="width: 100%;">
                  <option value="">Pilih target Yang Bertugas</option>
                  <option value="089565656665">089565656665</option>
                  <option value="081234567890">081234567890</option>
                  <option value="082112345678">082112345678</option>
                  <option value="085612345678">085612345678</option>
                  <option value="087812345678">087812345678</option>
                  <option value="089912345678">089912345678</option>
                  <option value="081356789012">081356789012</option>
                  <option value="082198765432">082198765432</option>
                  <option value="085698765432">085698765432</option>
                  <option value="087898765432">087898765432</option>

                </select>
              </div>
              <div class="form-group">
                <label for="message">Pesan</label>
                <textarea class="form-control" id="message" rows="3" placeholder="Enter your message" required></textarea>
              </div>
              <div class="form-group d-none">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" placeholder="Enter URL (optional)">
              </div>
              <div class="form-group d-none">
                <label for="filename">Filename</label>
                <input type="text" class="form-control" id="filename" placeholder="Enter filename (optional)">
              </div>
              <div class="form-group">
                <label for="schedule">Schedule</label>
                <input type="datetime-local" class="form-control" id="schedule" placeholder="Select schedule (optional)">
              </div>

              <div class="form-group d-none">
                <label for="delay">Delay (seconds)</label>
                <input type="number" class="form-control" id="delay" value="2" placeholder="Enter delay in seconds">
              </div>
              <div class="form-group d-none">
                <label for="countryCode">Country Code</label>
                <input type="text" class="form-control" id="countryCode" value="62" placeholder="Enter country code">
              </div>
              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary">Send Message</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
  </div>
  <!-- /.content-wrapper -->

<?php } else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>