<style type="text/css">
  .sidebar-light-success .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #005331;
    color: #fff;
  }

  .text-success {
    color: #005331 !important;
  }
</style>
<?php
if (file_exists(FCPATH . "/uploads/imgs/users/" . $AppClass->session->get($AppClass->AppModule . "UserID") . ".jpg")) {
  $profile_pic = base_url() . "/uploads/imgs/users/" . $AppClass->session->get($AppClass->AppModule . "UserID") . ".jpg";
} else {
  $profile_pic = base_url() . "/assets/img/user-no-pic.png";
}


?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-success elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url() ?>" class="brand-link">
    <img src="<?php echo base_url() ?>/assets/img/logo.png?<?php echo rand() ?>" alt="Logo" class="brand-image img-circle elevation-3zz" style="opacity: .8">
    <span class="brand-text font-weight-bold text-success"><?php echo $BrandAplikasi ?></span><span class="brand-text text-dark" style="font-size:16px !important;"> <?php echo $BrandInstitusi ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <?php if ($AppClass->session->get($AppClass->AppModule . "UserName")) { ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex  align-items-center">
        <div class="image">
          <img src="<?php echo $profile_pic ?>?<?php echo rand() ?>" class="img-circle elevation-2" alt="User Image">
        </div>
         <div class="info d-flex flex-column">
          <a href="#" class="d-block" style="font-size:14px"><?php echo $AppClass->session->get($AppClass->AppModule . "UserName") ?></a>
          <span class="role-text font-weight-bold d-none" style="font-size:13px"><?php echo $AppClass->session->get($AppClass->AppModule . "RoleName") ?></span>
        </div>
      </div>
    <?php } ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!--<li class="nav-item has-treeview menu-open">-->

        <?php
        //	echo $KodeMenu;
        $ChildrenCnt = 0;
        $ChildrenStage = 0;
        if (isset($oQueryMnuTop)) { //echo count($oQueryMnuTop); die();
          if (count($oQueryMnuTop) > 0) {
            $i = 0;
            $IdxInduk = "";
            $FirstNode = true;
            //			$ChildrenCnt = 0;
            //			$ChildrenStage = 0;
            foreach ($oQueryMnuTop as $oRS) {
              // tambah cek if Aktif
              if ($oRS->Aktif == 1) {
                $hash = hash('sha512', rand());
                $pos = substr(rand(), 0, 1);
                $mnu = $pos . substr($hash, 0, 128 - intval($pos)) . $oRS->KodeMenu . substr($hash, -1 * intval($pos));
                if ($ChildrenCnt == 0 && $FirstNode) $ChildrenStage = $oRS->LevelMenu;
                if ($IdxInduk != substr($oRS->Idx, 0, strlen($oRS->Idx) - 6 - strlen($oRS->KodeMenu)) && $ChildrenCnt > 0) {
                  while ($ChildrenStage > $oRS->LevelMenu) {
                    $ChildrenStage--; ?>
      </ul>
    <?php
                    if ($ChildrenStage >= $oRS->LevelMenu) echo "</li>";
                  }
                }
                //				echo $oRS->LevelMenu;

                if ($oRS->LevelMenu == 0) {
                  $sClassActive = "";
                  if ($oRS->AdaSubMenu == "0") {
                    $ChildrenCnt++;
    ?>
      <li class="nav-item">
        <a href="<?php echo base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu ?>/" class="nav-link<?php if (strpos("mnu" . $KodeMenu, "mnu" . $oRS->KodeMenu) !== false) {
                                                                                                                                                          echo " active";
                                                                                                                                                        } ?>">
          <i class="nav-icon <?php echo $oRS->Ikon ?>"></i>
          <p>
            <?php echo ucfirst($oRS->Alias) ?>
          </p>
        </a>
      </li>
    <?php
                  } else {
                    $FirstNode = true;
                    $ChildrenCnt = 0;
    ?>
      <li class="nav-item has-treeview<?php if (strpos("mnu" . $KodeMenu, "mnu" . $oRS->KodeMenu) !== false) {
                                        echo " menu-open";
                                      } ?>">
        <a href="#" class="nav-link<?php if (strpos("mnu" . $KodeMenu, "mnu" . $oRS->KodeMenu) !== false) {
                                      echo " active";
                                    } ?>">
          <i class="nav-icon <?php echo $oRS->Ikon ?>"></i>
          <p>
            <?php echo ucfirst($oRS->Alias)  ?>
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
        <?php         }
                } else {
                  if ($oRS->AdaSubMenu == "0") {
                    $ChildrenCnt++; ?>

          <li class="nav-item">
            <a href="<?php echo base_url() . "/" . strtolower($controller_name) . "/mnu/" . substr(md5(rand()), 4, 7) . "/salt/" . $mnu ?>/" class="nav-link<?php if (strpos("mnu" . $KodeMenu, "mnu" . $oRS->KodeMenu) !== false) {
                                                                                                                                                              echo " active";
                                                                                                                                                            } ?>">
              <i class="<?php echo $oRS->Ikon ?> nav-icon"></i>
              <p><?php echo $oRS->Alias;
                    if ($oRS->KodeMenu == "0413" && intval($Label0413) > 0) { ?>
                  <span class="badge badge-info right"><?php echo $Label0413 ?></span>
                <?php } ?>
              </p>
            </a>
          </li>
        <?php
                  } else {
                    $FirstNode = true;
                    $ChildrenCnt = 0; ?>
          <li class="nav-item has-treeview<?php if (strpos("mnu" . $KodeMenu, "mnu" . $oRS->KodeMenu) !== false) {
                                            echo " menu-open";
                                          } ?>">
            <a href="#" class="nav-link<?php if (strpos("mnu" . $KodeMenu, "mnu" . $oRS->KodeMenu) !== false) {
                                          echo " active";
                                        } ?>">
              <i class="nav-icon <?php echo $oRS->Ikon ?>"></i>
              <p>
                <?php echo ucfirst($oRS->Alias)  ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
    <?php         }
                }
                //				$ChildrenStage=$oRS->LevelMenu;
                $IdxInduk = substr($oRS->Idx, 0, strlen($oRS->Idx) - 6 - strlen($oRS->KodeMenu));
              }
            } // if aktif
          }
        }
        while ($ChildrenStage > 0) {
          $ChildrenStage--; ?>
            </ul>
          <?php
          if ($ChildrenStage >= 0) echo "</li>";
        }
          ?>




          <li class="nav-item">
            <a href="<?php echo base_url() ?>/bsa/chgpwdfrm" class="nav-link nav-chgpwd">
              <i class="nav-icon fas fa-lock-open"></i>
              <p>
                Ganti Password
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>/bsa/do_logout" class="nav-link nav-logout">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <!-- <li class="nav-header">PANDUAN</li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li> -->

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>