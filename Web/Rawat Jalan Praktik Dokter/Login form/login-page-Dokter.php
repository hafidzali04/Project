<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   Form Login Dokter
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
 
</head>

<body class="login-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="">
         Form Login Dokter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">apps</i> Login
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="login-page.php" class="dropdown-item">
                <i class="material-icons">content_paste</i> Login Pegawai
              </a>
            </div>
         
        </ul>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" style="background-image: url('../assets/img/1.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="POST" action="proses_login_dok.php">
              <div class="card-header card-header-primary text-center">
                <h3 class="card-title">Selamat Datang</h3><p>
                <div class="social-line">
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                     <i class="material-icons">apps</i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                    <i class="material-icons">layers</i>
                  </a>
                  <a href="#pablo" class="btn btn-just-icon btn-link">
                     <i class="material-icons">face</i>
                  </a>
                </div>
              </div>
              <p class="description text-center">Masukan ID dan Password</p>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">content_paste</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="username" placeholder="ID Dokter...">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" name="password" placeholder="Password...">
                </div>
              </div>
              <div class="footer text-center">
                <input type="submit" name="login" class="btn btn-info btn-link btn-wd btn-lg" value="Login">
                
                <!-- <a href="#pablo" class="btn btn-info btn-link btn-wd btn-lg">Login</a> -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        
        <div class="copyright float-right">
          &copy;
          <script>
            document.write(new Date().getFullYear())
          </script>, Sistem Informasi Manajemen Pendaftaran Rawat Jalan
          
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="../assets/js/plugins/moment.min.js"></script>
</body>

</html>