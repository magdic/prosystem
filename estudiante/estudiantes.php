<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../model/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../model/functions.php";

?>
<!DOCTYPE html>
<html data-ng-app="myApp" lang="en">
<!--[if IE 8]> <html class="no-js lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]> <html class="ie9" lang="en"> <![endif]-->
<!--[if IE 10]> <html class="ie10" lang="en"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]> <html lang="en"> <![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.png">

    <title>Prosystem  | Estudiante</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/themelogged.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/magnific-popup.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="../js/modernizr.custom.js"></script>
  </head>

  <body>
  		<?php
	    $uid = $_SESSION['uid'];
		$res = mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid."'");
		//split all fields fom the correct row into an associative array
		$row = mysql_fetch_assoc($res);

		//if the login session does not exist therefore meaning the user is not logged in
		if(!$_SESSION['uid']){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";
		}else if ($row['role'] != 2){
			echo "<center>Esta es la seccion de Estudiantes  <b>Necesitas Iniciar Sesion como uno!</b></center>";
		} else {
			//otherwise continue the page

			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
			
			?>


    <!-- end Theme Options (for demo purposes only) -->

    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper cbp-af-header">
      <div class="container">

        <!-- Fixed navbar -->
        <div class="navbar cbp-af-inner" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <h1><a class="navbar-brand scroll" href="./">Prosystem</a></h1>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right">
                <li><a href="perfil.php">Mi Perfil</a></li>
                <li><a href="">Estudiantes</a></li>
                <li><a href="profesores.php">Profesores</a></li>
              </ul>
                <span class="user-info">
                    <small>Bienvenido,</small>
                    <?php echo $row['name'].' '.$row['lastname']; ?>
                    <a href="../logout.php">Salir</a>
                </span>
            </div>
          </div>
        </div>

      </div>
    </div>





    <!-- About Section
    ================================================== -->
    <section id="about" class="content text-center light">

<div class="page-content"  >
      	<div ng-controller="customersCrtl">
			<div class="container">
			    <div class="row">
			        <div class="col-md-2">Cantidad de Resultados:
			            <select data-ng-model="entryLimit" class="form-control">
			                <option>5</option>
			                <option>10</option>
			                <option>20</option>
			                <option>50</option>
			                <option>100</option>
			            </select>
			        </div>
					<div class="col-md-2">Zona:
			            <select ng-model="search" ng-change="filter()"class="form-control">
			                <option>San Ramón</option>
			                <option>Palmares</option>
			                <option>Naranjo</option>
			                <option>Orotina</option>
			            </select>
			        </div>
			        <div class="col-md-3">Búsqueda:
			            <input type="text" ng-model="search" ng-change="filter()" placeholder="Búsqueda de Estudiantes..." class="form-control" />
			        </div>
			        <div class="col-md-4">
			            <h5>Mostrando {{ filtered.length }} de un total de {{ totalItems}} Estudiantes.</h5>
			        </div>
			    </br> 
			    </br> 
			    </br> 
			    </br> 
			    <div class="row">
			        <div class="col-md-12" data-ng-show="filteredItems > 0">
			            <table class="table table-striped table-bordered">
			            <thead>
			            <th>Nombre&nbsp;</th>
			            <th>Zona&nbsp;</th>
			            <th>Contactar&nbsp;</th>
			            </thead>
			            <tbody>
			                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
			                    <td>{{data.name}} &nbsp; {{data.lastname}}</td>
			                    <td>{{data.zona}}</b></td>
			                    <td>{{data.email}}</td>
			                </tr>
			            </tbody>
			            </table>
			        </div>
			        <div class="col-md-12" data-ng-show="filteredItems == 0">
			            <div class="col-md-12">
			                <h4>Estudiantes no encontrado.</h4>
			            </div>
			        </div>
			        <div class="col-md-12" data-ng-show="filteredItems > 0">    
			            <div data-pagination="" data-page="currentPage" data-on-select-page="setPage(page)" data-boundary-links="true" data-total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" data-previous-text="&laquo;" data-next-text="&raquo;"></div>
			            
			            
			        	</div>
			    	</div>
				</div>
			</div>
		</div>
  


      </div>




    </section>






    <!-- Footer
    ================================================== -->
    <footer id="contact" class="footer">

      <div class="container">    
        <div class="row">
          <div class="col-lg-12">
            <div class="col-sm-3 col-md-3">
              <div class="footer-logo">
                <h2>Prosystem</h2>
                <p>Direccion, Ciudad PROVINCIA<br>+506 2456-7890</p>
                <br>
                <p class="muted">© 2014 Prosystem.</p>
                <a href="#" class="terms-service">Terminos de Servicio</a>    
                <a href="#">Privacidad</a>
              </div>
            </div>
            <div class="col-sm-3 col-md-3">
              <h3>Producto</h3>
              <ul class="list-unstyled">
                <li><a href="#">Producto para Profesores</a></li>
                <li><a href="#">Producto para Estudiantes</a></li>         
              </ul>
            </div>
            <div class="col-sm-3 col-md-3">
              <h3>Company</h3>
              <ul class="list-unstyled">
                <li><a href="#about">Acerca de</a></li>
                <li><a href="#">Nuestro Equipo</a></li>
                <!-- <li><a href="#">Jobs&emsp;<span class="label label-info">We're hiring!</span></a></li>            -->
              </ul>
            </div>
            <div class="col-sm-3 col-md-3">
              <h3>Documentación</h3>
              <ul class="list-unstyled">
                <li><a href="#">Ayuda del Sitio</a></li>
                <!-- <li><a href="#">Developer API</a></li> -->
                <!-- <li><a href="#">Product Markdown</a></li>              -->
              </ul>
            </div>  
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 text-center">
            <a class="icon" href="http://www.twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
            <a class="icon" href="http://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
          </div>
        </div>
      </div>

    </footer>

  
    <div id="terms-service" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="login-part">
        <p class="login-overlay">
          Terminos de Servicio
        </p>

          <p>By signing up, you agree with our <span>Terms of Service,</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

       </section>
      
    </div>


 
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/classie.js"></script>
	<script src="../js/cbpAnimatedHeader.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <!-- <script src="../js/scrollReveal.js"></script>
    <script src="../js/jquery.scrollTo.js" defer="defer"></script>
    <script src="../js/jquery.nav.js" defer="defer"></script> -->
    <script src="../js/imagesloaded.pkgd.min.js" defer="defer"></script>
    <script src="../js/isotope.min.js" defer="defer"></script>
    <script src="../js/jquery.magnific-popup.min.js" defer="defer"></script>
    <script src="../js/jqBootstrapValidation.js" defer="defer"></script>
    <!-- <script src="../js/custom.js"></script>  -->

    <script src="../js/less-1.6.1.min.js"></script>

    <script>

      $(document).ready(function(){

        // isotope();
        // signupOverlay();
        // loginOverlay();
        // termServiceOverlay();

         $('.theme-option').click(function(event){
            event.preventDefault();
            less.modifyVars({
                '@theme-cta': $(this).attr('data-theme')
            });

            less.refreshStyles();
        });

      });

      // $.each(['css/theme.less'], function (index, fileName) {
      //     var $sheet = $('<link />', {
      //         href: fileName,
      //         rel: 'stylesheet/less',
      //         type: 'text/css'
      //     }).appendTo('head');
      //     less.sheets.push($sheet[0]);
      // });
      // less.refresh();

    </script>

    <script type="text/javascript" src="http://use.typekit.net/ump8und.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <script src="../js/angular.min.js"></script>
    <script src="../js/ui-bootstrap-tpls-0.10.0.min.js"></script>
    <script src="../js/appEstudiantes.js"></script>    

    <?php 
    	//make sure you close the check if their online
		}
	?>
  </body>
</html>
