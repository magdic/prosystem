<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../model/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../model/functions.php";

?>
<!DOCTYPE html>
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

    <title>Prosystem  | Profesor</title>

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
		}else if ($row['role'] != 4){
			echo "<center>Esta es la seccion de Profesores  <b>Necesitas Iniciar Sesion como uno!</b></center>";
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
                <li><a href="estudiantes.php">Estudiantes</a></li>
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

      <div class="container">
        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-12 overlay-text">
            <h2>Perfil</h2>
          </div>
        </div>

<!--         <div class="row">
          <div class="col-sm-4 text-center overlay-text icons">
            <div class="icon-wrapper">
              <i class="fa fa-cloud icon-large"></i>
            </div>
            <h3>El cielo es el limite</h3>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
          </div> -->
          <div class="col-sm-12 text-center overlay-text icons">
            <!-- <div class="icon-wrapper"> -->
              <!-- <img src="http://www.findthatlogo.com/wp-content/gallery/pepsi-logos/old-pepsi-logo.jpg" width="125px"> -->
              <!-- <i class="fa fa-rocket icon-large"></i> -->
            <!-- </div> -->
            <!-- <section class="register-part"> -->
	            <form role="form" action="../controllers/editprofe2.php" method="post" enctype="multipart/form-data">
				<label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Nombre:</label>
				<div class="col-sm-8">
                    <input type="text" id="form-field-2 name" name="name" placeholder="Escriba su Nombre" value="<?php echo $row['name']  ?>" class="col-xs-12 col-sm-10 editinput">
                </div>

                <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Apellido:</label>
				<div class="col-sm-8">
                    <input type="text" id="form-field-2 headline" name="lastname" placeholder="Escriba su Apellido" value="<?php echo $row['lastname'] ?>" class="col-xs-12 col-sm-10 editinput">
                </div>

                <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Zona:</label>
        <div class="col-sm-8">
               
                    <select name="zona" id="zona" class="form-control col-xs-12 col-sm-10" >
                        <option>San Ramón</option>
                        <option>Palmares</option>
                        <option>Naranjo</option>
                        <option>Orotina</option>
                        <option selected="<?php echo $row['zona'] ?>"><?php echo $row['zona'] ?></option>
                    </select>
                </div>

                <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">E-mail:</label>
				<div class="col-sm-8">
                    <input type="email" id="form-field-2 headline" name="email" placeholder="Digite su correo@email.com" value="<?php echo $row['email']  ?>" class="col-xs-12 col-sm-10 editinput">
                </div>

                <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Telefono Casa:</label>
				<div class="col-sm-8">
                    <input type="text" id="form-field-2 headline" name="telefonocasa" pattern=".{8,8}" maxlength="8" placeholder="Numero de Casa" value="<?php echo $row['telefonocasa'] ?>"class="col-xs-12 col-sm-10 editinput">
                </div>

                <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Celular:</label>
				<div class="col-sm-8">
                    <input type="text" id="form-field-2 headline" name="mobil" id="mobil"  pattern=".{8,8}" maxlength="8" placeholder="Numero de Celular" value="<?php echo $row['mobil']  ?>"class="col-xs-12 col-sm-10 editinput">
                </div>

                <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Facebook:</label>
        <div class="col-sm-8">
                    <input type="text" id="form-field-2 headline" name="facebook" id="facebook"  placeholder="Facebook" value="<?php echo $row['facebook']  ?>"class="col-xs-12 col-sm-10 editinput">
                </div>

              <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Años de Experiencia:</label>
        <div class="col-sm-8">
                    <input type="text" id="form-field-2 headline" pattern=".{1,2}" maxlength="2" name="experiencia" id="experiencia"  placeholder="Experiencia" value="<?php echo $row['experiencia']  ?>"class="col-xs-12 col-sm-10 editinput">
                </div>

                <label class="col-sm-3 control-label no-padding-right my-labels" for="form-field-2">Materias:</label>
        <div class="col-sm-8">
                    <input type="checkbox" id="form-field-2 headline" name="materia1" id="materia1"  value="Español" class="col-xs-1 col-sm-1 editinput">Español</br>
                    <input type="checkbox" id="form-field-2 headline" name="materia2" id="materia2"  value="Estudios Sociales / Civica" class="col-xs-1 col-sm-1 editinput">Estudios Sociales / Civica</br>
                    <input type="checkbox" id="form-field-2 headline" name="materia2" id="materia3"  value="Ciencias" class="col-xs-1 col-sm-1 editinput">Ciencias</br>
                    <input type="checkbox" id="form-field-2 headline" name="materia2" id="materia4"  value="Matemáticas" class="col-xs-1 col-sm-1 editinput">Matemáticas</br>
                    <input type="checkbox" id="form-field-2 headline" name="materia2" id="materia5"  value="Inglés" class="col-xs-1 col-sm-1 editinput">Inglés</br>
                </div>

	            <input type="submit" name="submit" class="btn edit">
	            </form>
            <!-- </section> -->
          </div>

        </div><!-- /.row -->
      </div>

      <div class="overlay-bg light"></div>

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
              </ul>
            </div>
            <div class="col-sm-3 col-md-3">
              <h3>Documentación</h3>
              <ul class="list-unstyled">
                <li><a href="#">Ayuda del Sitio</a></li>
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



         $('.theme-option').click(function(event){
            event.preventDefault();
            less.modifyVars({
                '@theme-cta': $(this).attr('data-theme')
            });

            less.refreshStyles();
        });

      });

      $("form").on("click", ":checkbox", function(event){
  $(":checkbox:not(:checked)", this.form).prop("disabled", function(){
    return $(this.form).find(":checkbox:checked").length == 3;
  });
});



    </script>

    <script type="text/javascript" src="http://use.typekit.net/ump8und.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <?php 
    	//make sure you close the check if their online
		}
	?>
  </body>
</html>
