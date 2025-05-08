<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/img/favicon.png?<?php echo rand() ?>">
  <title><?php echo $AppClass->NamaAplikasi ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .login-box {
      width: 320px !important;
    }

    .img {
      -webkit-filter: grayscale(100%);
      /* Safari 6.0 - 9.0 */
      filter: grayscale(100%);
    }

    /* .bg-olive {
     background-color: #005331 !important;
    }
    .text-olive {
     color: #005331 !important;
    } */
  </style>
</head>

<body class="hold-transition login-page" style="background:url('<?= base_url() ?>/assets/img/bg_login_.jpg?<?php echo rand() ?>') center bottom no-repeat; background-size:cover; ">
  <div class="login-box bg-white" style="padding:20px; border-radius:20px">
    <div class="login-logo">
      <a href="<?= base_url() ?>/" class="text-navy font-weight-bold">SIECANTIKPOL</a><br>
      <span class="text-dark" style="font-size:12px !important;"><?= $NamaAplikasi ?></span>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body bg-navy">
        <p class="login-box-msg">Sign in to start your session</p>

        <form class="form-horizontal form-material" id="loginform" action="<?php echo base_url() ?>bsa" method="post">
          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <input name="UserID" type="text" class="form-control" placeholder="User ID">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user text-warning"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="UserPassword" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock text-warning"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8" style="display:none">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <!--<div class="col-4">-->
            <div class="col-12">
              <button type="submit" class="btn btn-warning btn-block submit">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3" style="display:none">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->
        <!--<p class="mb-1" style="display:none">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>-->
      </div>
      <!-- /.login-card-body -->
    </div>
    <div class="login-card-footer text-center text-muted">
      &copy; <?php echo $AppClass->NamaInstitusi ?>
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>

  <script language="javascript">
    $(document).ready(function() {
      // ###################################################################################
      var token = 'ci_csrf_token',
        hash = '';
      $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        if (options.type.toLowerCase() === "post") {
          // initialize `data` to empty string if it does not exist
          options.data = options.data || "";

          // add leading ampersand if `data` is non-empty
          options.data += options.data ? "&" : "";

          // add _token entry
          options.data += token + "=" + hash;
        }
      });
      // ###################################################################################
      $('.form-control').on('keypress', function(e) {
        if (e.which == 13) {
          e.preventDefault();
          doLogin(e);
        }
      });
      $('.submit').on('click', function(e) {
        e.preventDefault();
        doLogin(e);
      });

      function doLogin(e) {
        var param = $('#loginform').serialize(),
          form = $('#loginform');
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>/bsa/login_process",
          data: param,
          success: function(response) {
            if (response.indexOf("<!--###-->") > 0) {
              arRsp = $.trim(response).split("<!--###-->");
              if (arRsp[0] == '0') {
                masukAplikasi();
              } else {
                Swal.fire({
                  title: "Login Gagal",
                  text: arRsp[1],
                  icon: "error"
                });
                $(form.find(".form-control:eq(" + arRsp[2] + ")")).select();
              }
            } else {
              Swal.fire({
                text: response,
                icon: "error"
              });
            }
          },
          error: function(xhr, sta, err) {
            var ErrMsg = strip_html_tags(xhr.responseText);
            if (ErrMsg == "") ErrMsg = err;
            Swal.fire({
              title: "Error " + xhr.status,
              text: ErrMsg,
              icon: "error"
            });
          }
        });
      }

      function strip_html_tags(str) {
        if ((str === null) || (str === ''))
          return false;
        else
          str = str.toString();
        return str.replace(/<[^>]*>/g, '');
      }

      function masukAplikasi() {
        var href = $(location).attr('href');
        window.location.replace(href);
      }
    });
  </script>

</body>

</html>