<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/modernui.css" rel="stylesheet">
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #e69500;
  border-radius: 50%;
  border-top: 16px solid #cc8400 ;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
.shake:hover {
  animation: shake 0.5s;
  animation-iteration-count: infinite;
}

@keyframes shake {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); }
}

</style>
  </head>
  <body onload="myFunction()" style="margin:0;background-image:url('wow.jpg');background-attachment: fixed;background-repeat: no-repeat;background-position:center;" >

<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">
  
 

<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 1500);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>

  <nav class="navbar navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header" style="color: white">

     <img style="max-width:500px; margin-top: -150px; margin-bottom: -150px;"src="imgjbs.png">  
     <button class="navbar-toggler" type="button"  data-toggle="modal" data-target="#myModal" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style="padding-left: 670px">
          <span class="navbar-toggler-icon"></span>
        </button>
         <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <img src="regards.jpg" class="img-responsive">
        </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
     <?PHP

function getUserIP()
{
  //whether ip is from share internet
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    //whether ip is from proxy
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    //whether ip is from remote address
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();

echo 'IP ADDRESS'.$user_ip;

?>
    </div>
  </div>
</nav>
<header>

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    
       
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('logohd.png')">
            <div class="carousel-caption d-none d-md-block">
            </div>
         
      </div>
</header>
    

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4"></h1>
      <div class="row">
	  
       <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100" style="background-color: black;">
            <a  href="www.petrochina.co.id" target="_blank"><img class="card-img-top shake" class="zoom" src="ICON/PORTAL.png" alt="" ></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="www.petrochina.co.id" style="color:#e67200" target="_blank">PetroChina Portal</a>
              </h4>
              <p class="card-text" style="color: white;">Portal PetroChina</p>
            </div>
          </div>
        </div>
		
       <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://jabung-field" target="_blank"><img class="card-img-top shake"  src="ICON/pcijabung.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://jabung-field" style="color:#e67200"target="_blank">PCI Jabung Field Portal</a>
              </h4>
              <p class="card-text"style="color: white;">Portal Jabung Field</p>
            </div>
          </div>
        </div>
		
       <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;" >
            <a href="https://mail.petrochina.co.id"target="_blank"><img class="card-img-top shake" src="ICON/webmail.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="https://mail.petrochina.co.id"style="color:#e67200"target="_blank">PCI Web Mail</a>
              </h4>
              <p class="card-text"style="color: white;">Portal Web Mail PCI</p>
            </div>
          </div>
        </div>
		
       <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://apps.jabung.com:602"target="_blank"><img class="card-img-top shake" src="ICON/vehicle.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://apps.jabung.com:602" style="color:#e67200"target="_blank">Vehicle Management System</a>
              </h4>
              <p class="card-text"style="color: white;">Portal Vehicle Managemen System</p>
            </div>
          </div>
        </div>
		
       <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://apps.jabung.com:929" style="color:#e67200"target="_blank"><img class="card-img-top shake" src="ICON/attendance.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://apps.jabung.com:929" style="color:#e67200"target="_blank">Attendance Management System</a>
              </h4>
              <p class="card-text"style="color: white;">Portal Attendance Management System</p>
            </div>
          </div>
        </div>
		
       <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://apps.jabung.com:600"target="_blank"><img class="card-img-top shake" src="ICON/medic.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://apps.jabung.com:600" style="color:#e67200"target="_blank">Integrated Health Management System (IHMS)</a>
              </h4>
              <p class="card-text"style="color: white;">Portal Integrated Health Management System (IHMS)</p>
            </div>
          </div>
        </div>
		
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://apps.jabung.com/pob"target="_blank"><img class="card-img-top shake" src="ICON/camp.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://apps.jabung.com/pob" style="color:#e67200"target="_blank">Geragai BaseCamp Personnel on Board</a>
              </h4>
              <p class="card-text"style="color: white;">Portal Geragai BaseCamp Personnel on Board</p>
            </div>
          </div>
        </div>
		
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://apps.jabung.com:600"target="_blank"><img class="card-img-top shake" src="ICON/medic.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://apps.jabung.com:600" style="color:#e67200"target="_blank">Integrated Health Management System (IHMS)</a>
              </h4>
              <p class="card-text"style="color: white;">Portal Integrated Health Management System (IHMS)</p>
            </div>
          </div>
        </div>
		
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="ftp://150.100.0.27"target="_blank"><img class="card-img-top shake" src="ICON/jkt.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="ftp://150.100.0.27" style="color:#e67200"target="_blank">FTP Jakarta</a>
              </h4>
              <p class="card-text"style="color: white;">Portal FTP Jakarta</p>
            </div>
          </div>
        </div>
		
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="ftp://192.168.5.13"target="_blank"><img class="card-img-top shake" src="ICON/bgp.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="ftp://192.168.5.13" style="color:#e67200"target="_blank">FTP BGP</a>
              </h4>
              <p class="card-text" style="color: white;">Portal FTP BGP</p>
            </div>
          </div>
        </div>
		
		   <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://172.16.11.39"target="_blank"><img class="card-img-top shake" src="ICON/jde1.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://172.16.11.39" style="color:#e67200"target="_blank">JDE-WEB9-1</a>
              </h4>
              <p class="card-text"style="color: white;" >JDE-WEB9-1</p>
            </div>
          </div>
        </div>
		
		    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100"style="background-color: black;">
            <a href="http://172.16.11.40"target="_blank"><img class="card-img-top shake" src="ICON/jde3.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="http://172.16.11.40" style="color:#e67200"target="_blank">JDE-WEB9-3</a>
              </h4>
              <p class="card-text" style="color: white;">JDE-WEB9-3</p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
     <!-- down-carousel bootstrap -->
 <div class="row">
    <div class=" col-sm-2"></div>
      <div class=" col-md-8">
       <?php
     $files = scandir("image/");
        ?> 
        <div id="carousel2_indicator" class="carousel slide carousel-fade" data-ride="carousel">
          <!-- wrapper slide -->
          <div class="carousel-inner">
            <?php
            $i=0;
              for ($a=2; $a<count($files); $a++):
            ?>
            <div class="carousel-item <?php echo $i == 0? 'active': ''; ?>" align="center" style="width: 100%">
              <img src="image/<?php echo $files[$a]; ?>" class="img-fluid" alt="Responsive image">     
            </div>
             <?php 
                 $i++;
                  endfor; 
              ?>
        </div>
            <a class="carousel-control-prev" href="#carousel2_indicator" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carousel2_indicator" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
             </a>
        </div> 
      </div>
      <div class=" col-sm-2"></div>
  </div>
</div>

    <!-- Footer -->
    <footer class="py-3" style="background:#e67200; ">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; PCI Jabung ltd. 2018</p>
      </div>

    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
