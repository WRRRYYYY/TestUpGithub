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

    .login-box {
      width: 320px !important;
    }

    .bg-success {
      background-color: #005331 !important;
    }

    .text-success {
      color: #005331 !important;
    }

    .g-recaptcha {
      margin: -10px 0 5px -22px;
      transform: scale(0.76);
      /* Ubah ukuran */
    }

    .logo-container {
      position: absolute;
      bottom: 0;
      right: 0;
      background: white;
      padding: 5px 10px;
      border-radius: 15px 0 0 0;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
      display: flex;
      align-items: center;
    }

    .text-logo {
      font-size: 12px;
      color: #333;
      margin-right: 10px;
      margin-top: 0px;
      font-weight: bold;
    }


    .logo-container img {
      height: 50px;
      margin-left: 5px;
      /* Sesuaikan jarak antar logo */
    }
  </style>
</head>

<body class="hold-transition login-page" style="background:url('<?= base_url() ?>/assets/img/bg_login.jpg?<?php echo rand() ?>') center bottom no-repeat; background-size:cover; ">
  <div class="login-box bg-white" style="padding:25px; border-radius:10px">
    <div class="login-logo">
      <div class="text-center">
        <!-- <img src="<?= base_url() ?>/assets/img/logo.png" alt="Logo Baznas" style="height: 60px; margin-right: 5px;">|
        <img src="<?= base_url() ?>/assets/img/logo.png" alt="Logo Kota" style="height: 60px; margin-left: 5px;"> -->
        <img src="<?= base_url() ?>/assets/img/logo.png?<?php echo rand() ?>" alt="Logo Kota" style="height: 80px;">
        <p class="text-success" style="font-weight:600;"><?= $BrandAplikasi ?></p>

      </div>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body bg-success">
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

            <div class="g-recaptcha w-100" data-sitekey="<?php echo $captcha ?>" data-theme="light" data-type="image" data-size="normal"></div>
            <br />
            <!--<div class="col-4">-->
            <!-- ori<div class="col-12">
              <button type="submit" class="btn btn-warning btn-block submit" style="background-color:#ffc300 !important;" >Sign In</button>
            </div>ori -->
            <div class="col-5 col-12zz">
              <button type="submit" class="btn btn-warning btn-block submit">Sign In</button>
            </div>
            <div class="col-7">
              <a href="<?= $linksso ?>" class="btn btn-light btn-block" style="background-color:#f9fafa !important">Sign in with
                <svg class="NEH9Ef" xmlns="https://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 40 48" aria-hidden="true" jsname="jjf7Ff">
                  <path fill="#4285F4" d="M39.2 24.45c0-1.55-.16-3.04-.43-4.45H20v8h10.73c-.45 2.53-1.86 4.68-4 6.11v5.05h6.5c3.78-3.48 5.97-8.62 5.97-14.71z"></path>
                  <path fill="#34A853" d="M20 44c5.4 0 9.92-1.79 13.24-4.84l-6.5-5.05C24.95 35.3 22.67 36 20 36c-5.19 0-9.59-3.51-11.15-8.23h-6.7v5.2C5.43 39.51 12.18 44 20 44z"></path>
                  <path fill="#FABB05" d="M8.85 27.77c-.4-1.19-.62-2.46-.62-3.77s.22-2.58.62-3.77v-5.2h-6.7C.78 17.73 0 20.77 0 24s.78 6.27 2.14 8.97l6.71-5.2z"></path>
                  <path fill="#E94235" d="M20 12c2.93 0 5.55 1.01 7.62 2.98l5.76-5.76C29.92 5.98 25.39 4 20 4 12.18 4 5.43 8.49 2.14 15.03l6.7 5.2C10.41 15.51 14.81 12 20 12z"></path>
                </svg>

              </a>
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
  <div class="logo-container d-none">
    <div class="text-logo">
      <span>Powered by</span>
    </div>
    <img src="<?= base_url() ?>/assets/img/logo.png" alt="Logo Baznas">
    <img src="<?= base_url() ?>/assets/img/logo.png" alt="Logo Kota">
  </div>



  <!-- jQuery -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>

  <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=onload&hl=en" async defer></script>

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
                grecaptcha.reset(); // Reset reCAPTCHA
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