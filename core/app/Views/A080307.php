<?= $this->extend('layout/bsa_main') ?>
<?= $this->section('main') ?>
<?php if (!$SessionEmpty) {  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $NamaMenu ?></h1>
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
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th class="text-center">&Sigma; Mustahiq</th>
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
                    $mnuprint = $pos . substr($hash, 0, 128 - intval($pos)) . "080303" . substr($hash, -1 * intval($pos)) . "/frm/cod" . $oRS->idx . "/";
                    
                    $docUrl = !empty($oRS->DokumenPath) ? "https://docs.google.com/viewer?embedded=true&url=" . urlencode($oRS->DokumenPath) : "#";
                    $isPreviewable = !empty($oRS->DokumenPath);
                    
                    $sDisabled = "";
                    if (!is_null($oRS->AjukanTanggal) || !is_null($oRS->ArsipTanggal)) {
                      $sDisabled = " disabled";
                    }
              ?>
                    <tr>
                      <td><?php echo $oRS->NomorSurat ?></td>
                      <td><?php echo $oRS->TanggalSurat ?></td>
                      <td><?php echo $oRS->Pengirim ?></td>
                      <td><?php echo $oRS->Perihal ?></td>
                      <td class="text-center"><?php echo $oRS->TotalMustahik ?></td>
                      <td style="width:40px; text-align:center">
                        <div class="btn-group">
                          <a href="<?php echo  base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu . $url_add ?>" class="btn btn-xs btn-info control-view" title="Edit Detail Permohonan"><i class="fas fa-list smalls"></i></a>
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
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal untuk Preview Dokumen -->
  <div class="modal fade" id="modalDokumen" tabindex="-1" aria-labelledby="modalDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDokumenLabel">Preview Dokumen</h5>
         

          </button>
        </div>
        <div class="modal-body">
          <iframe id="iframeDokumen" src="" width="100%" height="500px" style="border: none;"></iframe>
          <div class="mt-3 text-center">
            <a id="openInNewTab" href="#" target="_blank" class="btn btn-primary d-none">Buka di Tab Baru</a>
          </div>
          <div class="d-flex">
            <a id="btnDownload" href="#" target="_blank" class="btn btn-primary btn-sm mr-2">
              <i class="fas fa-download"></i> Download
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
              <i class="fas fa-times"></i> Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php } else {
  echo $html_SessionEmpty;
} ?>
<?= $this->endSection() ?>