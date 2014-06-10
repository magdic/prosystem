
<?php
//allow sessions to be passed so we can see if the user is logged in
//asjdf;lasjdflaksjdf;lakdjfa;slkdjf;alksjf;lajf
session_start();


//connect to the database so we can check, edit, or insert data to our users table
include('model/dbconfig.php');

//include out functions file giving us access to the protect() function
include "model/functions.php";

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

    <title>Prosystem | Busca tu profe</title>

    <!-- <link rel="stylesheet" type="text/css" href="css/validatecard.css"> -->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    

    <!-- Custom styles for this template -->
    <link href="css/magnific-popup.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="js/modernizr.custom.js"></script>
  </head>

  <body>
    <?php
      if($_GET['message'] == 'edeb734ec075b20cd9e995a05888270e'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-success'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                                <p>
                                    <strong><i class='icon-ok'></i></strong>
                                    Su cuenta se ha creado correctamente, por favor revise su direccion de correo electronica para activar su cuenta!.
                                </p>
                          </div>
                       </div>
                  </div>";
      }
      if($_GET['message'] == 'a23e3efffdd987d1ef098e1d25199b38'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                  El <b>e-mail</b> que digito ya existe!
                                  <br />
                          </div>
                       </div>
                  </div>";
      }
      if($_GET['message'] == '288a62414db78c24149f396d8e4d6bc2'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                  Las <b>contraseñas</b> tienen que ser iguales!
                                  <br />
                          </div>
                       </div>
                  </div>";
      }
      if($_GET['message'] == '08bfefacdbd9b8dc8d8f3f2cba0645e3'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                  Necesitas llenar todos los campos!
                                  <br />
                          </div>
                       </div>
                  </div>";
      }
      if($_GET['message'] == 'f601b5d64fec441496b4f4899cd5aba4'){

            echo "<div class='row'>
                       <div class='col-sm-6 col-sm-offset-3'>
                          <div class='alert alert-danger'>
                              <button type='button' class='close' data-dismiss='alert'>
                                  <i class='icon-remove'></i>
                              </button>
                              <strong>
                                   <i class='icon-remove'></i>

                              </strong>
                                La <b>contraseña</b> debe contener entre 5 y 32 caracteres de largo!
                                  <br />
                          </div>
                       </div>
                  </div>";
      }
      // $msg=$_GET['message'];
      // echo '<center>'.$msg.'</center>';


//If the user has submitted the form
    if($_POST['submit']){
      //protect the posted value then store them to variables
      $email = protect($_POST['emailLogin']);
      $password = protect($_POST['passwordLogin']);

      //Check if the username or password boxes were not filled in
      if(!$email || !$password){
        //if not display an error message
                echo    "<div class='row'>
                             <div class='col-sm-6 col-sm-offset-3'>
                                <div class='alert alert-danger'>
                                    <button type='button' class='close' data-dismiss='alert'>
                                        <i class='icon-remove'></i>
                                    </button>
                                    <strong>
                                         <i class='icon-ban-circle'></i>

                                    </strong>
                                        Necesita llenar ambos campos <b>correo electronico</b> y <b>Contraseña</b>!
                                        <br />
                                </div>
                             </div>
                        </div>";
      }else{
        //if the were continue checking

        //select all rows from the table where the username matches the one entered by the user
        $res = mysql_query("SELECT * FROM `users` WHERE `email` = '".$email."'");
        $num = mysql_num_rows($res);

        //check if there was not a match
        if($num == 0){
          //if not display an error message

                    echo "<div class='row'>
                             <div class='col-sm-6 col-sm-offset-3'>
                                <div class='alert alert-danger'>
                                    <button type='button' class='close' data-dismiss='alert'>
                                        <i class='icon-remove'></i>
                                    </button>
                                    <strong>
                                         <i class='icon-ban-circle'></i>

                                    </strong>
                                        El <b>Correo electronico</b> no existe!
                                        <br />
                                </div>
                             </div>
                        </div>";
        }else{
          //if there was a match continue checking

          //select all rows where the username and password match the ones submitted by the user
          $res = mysql_query("SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".md5($password)."'");
          $num = mysql_num_rows($res);

          //check if there was not a match
          if($num == 0){
            //if not display error message

                        echo "<div class='row'>
                                 <div class='col-sm-6 col-sm-offset-3'>
                                    <div class='alert alert-danger'>
                                        <button type='button' class='close' data-dismiss='alert'>
                                            <i class='icon-remove'></i>
                                        </button>
                                        <strong>
                                             <i class='icon-ban-circle'></i>

                                        </strong>
                                            La <b>contraseña</b> no es valida para el correo digitado!
                                            <br />
                                    </div>
                                 </div>
                            </div>";
          }else{
            //if there was continue checking

            //split all fields fom the correct row into an associative array
            $row = mysql_fetch_assoc($res);

            //check to see if the user has not activated their account yet
            if($row['active'] != 1){
              //if not display error message

                            echo "<div class='row'>
                                     <div class='col-sm-6 col-sm-offset-3'>
                                        <div class='alert alert-danger'>
                                            <button type='button' class='close' data-dismiss='alert'>
                                                <i class='icon-remove'></i>
                                            </button>
                                            <strong>
                                                 <i class='icon-ban-circle'></i>

                                            </strong>
                                                Usted aun no ha  <b>activado</b> su cuenta!
                                                <br />
                                        </div>
                                     </div>
                                </div>";
            }else{
              //if they have log them in
              $_SESSION['uid'] = $row['id'];
              //set the login session storing there id - we use this to see if they are logged in or not
              if ($_SESSION['uid'] = $row['id'] && $row['role'] == 1){
                  $_SESSION['uid'] = $row['id'];
              //if($row['role'] == 1) {
              //Redirect to the user page
                //update the online field to 50 seconds into the future
              $time = date('U')+50;
              mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
              echo '<script>window.location.href="admin"</script>';

            } else if ($_SESSION['uid'] = $row['id'] && $row['role'] == 2) {
              $_SESSION['uid'] = $row['id'];
              //update the online field to 50 seconds into the future
              $time = date('U')+50;
              mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
              echo '<script>window.location.href="estudiante"</script>';
            }
            else {
              $_SESSION['uid'] = $row['id'];
              //update the online field to 50 seconds into the future
              $time = date('U')+50;
              mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
              echo '<script>window.location.href="app/pm/pm-panel.php"</script>';
            }

              //update the online field to 50 seconds into the future
              $time = date('U')+50;
              mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");

              //redirect them to the usersonline page
              header('Location: usersOnline.php');
            }
          }
        }
      }
    }



    ?>

    <div class="preloader">
      <!-- <img src="http://thehangar.cr/images/thi-logos.png"></img> -->
       <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
          <div class="bounce4"></div>
          <div class="bounce5"></div>
        </div>
    </div>



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
              <h1><a class="navbar-brand scroll" href="#intro">Prosystem</a></h1>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right">
                <li><a href="#about">Acerca de</a></li>
                <li><a href="#featured1">Características</a></li>
                <li><a href="#gente">Gente</a></li>
                <li><a href="#pricing">Precios/Registro</a></li>
                <li><a class="hidden-sm login" href="#">Ingresar</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>


    <!-- Hero Banner
    ================================================== -->
    <div id="intro">
        <div class="item background-cover" style="background: url('img/bg-featuredapp1.jpg') 50% 50%">
          <div class="container">
            <div class="row">
              <div class="carousel-caption-center colour-white">
                <h2>Prosystem</h2>
                <h1>Busca a tu profe.</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna sem mollis sed odio dui malesuada euismod.</p>
                <!-- <p><a class="btn btn-lg btn-primary signup" href="#" role="button">Comenzar</a></p> -->
              </div>
            </div>
          </div>
          <div class="overlay-bg"></div>
        </div>
    </div>



    <!-- About Section
    ================================================== -->
    <section id="about" class="content text-center light">

      <div class="container">
        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-12 overlay-text">
            <h2>Prosystem</h2>
          </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-sm-4 text-center overlay-text icons">
            <div class="icon-wrapper">
              <i class="fa fa-bookmark icon-large"></i>
            </div>
            <h3>Misión</h3>
            <p>Somos una empresa de servicio que busca satisfacer la necesidad de ofrecer oportunidades de trabajo a los educadores en las zonas de San Ramón, Palmares, Naranjo y Orotina, al mismo tiempo proporcionar a estudiantes de secundaria una alternativa en línea para contratar profesores particulares.</p>
          </div>
          <div class="col-sm-4 text-center overlay-text icons">
            <div class="icon-wrapper">
              <i class="fa fa-bullseye icon-large"></i>
            </div>
            <h3>Visión</h3>
            <p>Ser la empresa en línea líder del mercado nacional, brindando un servicio de calidad a quienes utilicen nuestro portal web, expandiéndonos a todo el país y abarcando los niveles académicos primaria, secundaria y universitaria.</p>
          </div>
          <div class="col-sm-4 text-center overlay-text icons">
            <div class="icon-wrapper">
              <i class="fa fa-lightbulb-o icon-large"></i>
            </div>
            <h3>Refuerza tus conocimientos</h3>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
          </div>
        </div><!-- /.row -->
      </div>

      <div class="overlay-bg light"></div>

    </section>


    <!-- Featured Sections
    ================================================== -->
    <section id="featured1" class="dark with-bg">

      <div class="container">
        <div class="row">
          <div class="col-sm-5 overlay-text">
            <div class="vertical-align">
              <h2>Estudie con su propio profesor</h2>
              <p>Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="overlay-bg black"></div>

    </section>


    <section id="featured2" class="featured">

      <div class="container">
        <div class="row">
          <div class="col-sm-5 text-center">
            <img class="margin-top img-responsive" src="img/thumbs/thumb3.jpg" alt="Generic placeholder image" data-scrollreveal="move 100px and enter from the left after 0.55s" width="429">
          </div>
          <div class="col-sm-5 col-sm-offset-1">
            <div class="vertical-align">
              <h2>Planifique sus clases en Línea</h2>
              <p>Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
          </div>
        </div>
      </div>

    </section>


    <!-- Testimonials
    ================================================== -->
    <section id="gente" class="dark">

      <div class="page-header text-center">
        <h3>Testimonios</h3>
        <h2>Lo que la gente dice</h2>
      </div>

      <div class="container">

        <div class='row'>
          <div class='col-md-offset-2 col-md-8'>
            <div class="carousel slide" data-ride="carousel" id="quote-carousel">
              <!-- Bottom Carousel Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#quote-carousel" data-slide-to="1"></li>
                <li data-target="#quote-carousel" data-slide-to="2"></li>
              </ol>
              
              <!-- Carousel Slides / Quotes -->
              <div class="carousel-inner">
              
                <!-- Quote 1 -->
                <div class="item active">
                  <blockquote>
                    <div class="row">
                      <div class="col-sm-3 text-center">
                        <img class="img-circle" src="img/user-avatar1.jpg">
                      </div>
                      <div class="col-sm-9">
                        <p>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit!"</p>
                        <small>David Parranda - <!--<a href="" target="_blank">@dparrelli</a>--></small>
                      </div>
                    </div>
                  </blockquote>
                </div>
                <!-- Quote 2 -->
                <div class="item">
                  <blockquote>
                    <div class="row">
                      <div class="col-sm-3 text-center">
                        <img class="img-circle" src="img/user-avatar2.jpg">
                      </div>
                      <div class="col-sm-9">
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor nec lacus ut tempor. Mauris."</p>
                        <small>Wanda Barranda - <!--<a href="http://www.workingnomads.co" target="_blank">@workingnomads</a>--></small>
                      </div>
                    </div>
                  </blockquote>
                </div>
                <!-- Quote 3 -->
                <div class="item">
                  <blockquote>
                    <div class="row">
                      <div class="col-sm-3 text-center">
                        <img class="img-circle" src="img/user-avatar3.jpg">
                      </div>
                      <div class="col-sm-9">
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum elit in arcu blandit, eget pretium nisl accumsan. Sed ultricies commodo tortor, eu pretium."</p>
                        <small>Chinita Mengana <!--- <a href="http://www.workingnomads.co" target="_blank">@workingnomads</a>--></small>
                      </div>
                    </div>
                  </blockquote>
                </div>
              </div>
              
              <!-- Carousel Buttons Next/Prev -->
              <a data-slide="prev" href="#quote-carousel" class="left carousel-control visible-md visible-lg"><i class="fa fa-chevron-left"></i></a>
              <a data-slide="next" href="#quote-carousel" class="right carousel-control  visible-md visible-lg"><i class="fa fa-chevron-right"></i></a>
            </div>                          
          </div>
        </div>
        </div>
      </div>

    </section>


    <!-- Gallery
    ================================================== -->
    <section id="equipo">

      <div class="page-header text-center">
        <h3>Nuestro Equipo</h3>
        <h2>Conoce nuestra Gente</h2>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div id="owl-example" class="owl-carousel">
              <div class="item">
                <a href="img/thumbs/thumb1.jpg" class="popup-gallery">
                  <img src="img/thumbs/thumb1.jpg" alt="Prestige Portfolio Thumbnail Image">
                </a>
              </div>
              <div class="item">
                <a href="img/thumbs/thumb2.jpg" class="popup-gallery">
                  <img src="img/thumbs/thumb2.jpg" alt="Prestige Portfolio Thumbnail Image">
                </a>
              </div>
              <div class="item">
                <a href="img/thumbs/thumb3.jpg" class="popup-gallery">
                  <img src="img/thumbs/thumb3.jpg" alt="Prestige Portfolio Thumbnail Image">
                </a>
              </div>
              <div class="item">
                <a href="img/thumbs/thumb4.jpg" class="popup-gallery">
                  <img src="img/thumbs/thumb4.jpg" alt="Prestige Portfolio Thumbnail Image">
                </a>
              </div>
              <div class="item">
                <a href="img/thumbs/thumb5.jpg" class="popup-gallery">
                  <img src="img/thumbs/thumb5.jpg" alt="Prestige Portfolio Thumbnail Image">
                </a>
              </div>
              <div class="item">
                <a href="img/thumbs/thumb6.jpg" class="popup-gallery">
                  <img src="img/thumbs/thumb6.jpg" alt="Prestige Portfolio Thumbnail Image">
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>

    </section>


    <!-- Pricing
    ================================================== -->
    <section id="pricing" class="dark">

      <div class="page-header text-center">
        <h3>Precios para registrarse</h3>
        <h2></h2>
      </div>

      <div class="container">
        <div class="row">
          <div class="plans">
              <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="plan" data-scrollreveal="enter over 1s">
                  <div class="plan-title">
                    <h2>Estudiante</h2>
                    <h3><sup>&cent;</sup>0</h3>
                  </div>

                  <ul class="plan-features">
                    <li>Busquedas por zona</li>
                    <li>Busquedas por materia</li>
                    <li>Información de Profesores</li>
                    <li>Descarga de Archivos</li>
                  </ul>
                  <div class="plan-cta">
                    <p class="plan-buy"><a href="#" class="btn signup">Seleccionar</a></p>
                 </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="plan featured" data-scrollreveal="enter over 1s">
                  <div class="plan-title">
                    <h2>Profesor</h2>
                    <h3><sup>&cent;</sup>10000</h3>
                  </div>

                  <ul class="plan-features">
                    <li>Soporte Tecnico</li>
                    <li>Solo una materia</li>
                  </ul>
                  <div class="plan-cta">
                    <p class="plan-buy"><a href="#" class="btn signupProfe">Seleccionar</a></p>
                 </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="plan featured" data-scrollreveal="enter over 1s">
                  <div class="plan-title">
                    <h2>Profesor Principal</h2>
                    <h3><sup>&cent;</sup>13000</h3>
                  </div>

                  <ul class="plan-features">
                    <li>Principal en las busquedas</li>
                    <li>Materias Basicas</li>
                  </ul>
                  <div class="plan-cta">
                    <p class="plan-buy"><a href="#" class="btn signupProfe2">Seleccionar</a></p>
                 </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="plan" data-scrollreveal="enter over 1s">
                  <div class="plan-title">
                    <h2>Profesor Pro</h2>
                    <h3><sup>&cent;</sup>15000</h3>
                  </div>

                  <ul class="plan-features">
                    <li>Pricipal en las busquedas</li>
                    <li>Busqueda de Estudiantes</li>
                    <li>Todas las Materias</li>
                    <li>Subida de Archivos</li>
                  </ul>
                  <div class="plan-cta">
                    <p class="plan-buy"><a href="#" class="btn signupProfe3">Seleccionar</a></p>
                 </div>
                </div>
              </div>
            </div>
        </div>
      </div>

    </section>


    <!-- Call to Action
    ================================================== -->
    <section class="cta text-center">

      <div class="container">
        
        <div class="row">
          <div class="col-lg-12">
            <h2>Comience a enseñar y aprender ahora.</h2>
            <p><a href="#pricing" class="btn" role="button">Inciar en Prosystem</a></p>
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
                <a href="#" class="privacy">Privacidad</a>
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
                <li><a href="#equipo">Nuestro Equipo</a></li>
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


    <!-- Login y registros -->

    <div id="login" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="login-part">
        <p class="login-overlay">
          Ingresar
        </p>
        <form action="index.php" method="post">
          <input class="form-control" type="email" name="emailLogin" placeholder="Email"  />
          <input class="form-control" type="password" name="passwordLogin" placeholder="Password"  />
          <input type="submit" name="submit" class="btn btn-sm btn-success">
          <a href="#" class="forgot-pw">Olvido su Contraseña?</a>
        </form>
       </section>
      
    </div>

    <!-- Registro de Estudiante  -->
    <div id="signup" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="register-part">
      
        <p class="login-overlay">
          Registrarse en Prosystem
        </p>
        <form action="controllers/regAction.php" method="post">
          <input class="form-control" type="hidden" name="role" placeholder="role" value="2"/>
          <input class="form-control" type="email" name="email" placeholder="Email" />
          <input class="form-control" type="password" name="password" placeholder="Password"  />
          <input class="form-control" type="password" name="passconf" placeholder="Repeat Password"  />
          <input type="submit" name="submit" class="btn btn-sm btn-success">
          <p class="disclaimer">Su cuenta sera creada como Usuario Estudiante, el primer acceso será enviado a su cuenta de correo.</p>
        </form>
       </section>
      
    </div>


    <!-- Profesor numero 1 -->
    <div id="signupProfe" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="register-part">
        <p class="login-overlay">
          Registrarse en Prosystem
        </p>
        <form  action="controllers/regAction.php" method="post">
          <input class="form-control" type="hidden" name="role" placeholder="role" value="3"/>
          <input class="form-control" type="email" name="email" placeholder="Email" />
          <input class="form-control" type="password" name="password" placeholder="Password"  />
          <input class="form-control" type="password" name="passconf" placeholder="Repeat Password"  />
          
        </hr>
        <h2 class="h2-cards">Detalle de Pagos</h2>

                    <li>
                        <ul class="cards">
                            <li class="visa off">Visa</li>
                            <li class="visa_electron off">Visa Electron</li>
                            <li class="mastercard off">MasterCard</li>
                            <li class="maestro">Maestro</li>
                            <li class="discover off">Discover</li>
                        </ul>
                    </li>



                        <input type="text" name="card_number" id="card_number" placeholder="Numero Tarjeta" pattern=".{16,16}" required>

                        <input type="text" name="cvv" id="cvv" maxlength="3" placeholder="CVV" pattern=".{3,3}" required>

                        <input type="text" class="expiry_date" name="expiry_date" id="expiry_date" maxlength="5" placeholder="Vencimiento mm/yy" required>
                    
                        <input type="text" class="issue_date" name="issue_date" id="issue_date" maxlength="5" placeholder="Emisión mm/yy" required>

                        <input type="text" name="name_on_card" id="name_on_card" placeholder="Dueño Tarjeta" required>

                <input type="submit" name="submit" class="btn btn-sm btn-success">


          <p class="disclaimer">Su cuenta sera creada como Profesor Regular, el primer acceso será enviado a su cuenta de correo. El cargo por crear esta cuenta es de <strong>&cent;10000</strong></p>
        </form>
       </section>
      
    </div>

    <div id="signupProfe2" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="register-part">
        <p class="login-overlay">
          Registrarse en Prosystem
        </p>
        <form  action="controllers/regAction.php" method="post">
          <input class="form-control" type="hidden" name="role" placeholder="role" value="4"/>
          <input class="form-control" type="email" name="email" placeholder="Email" />
          <input class="form-control" type="password" name="password" placeholder="Password"  />
          <input class="form-control" type="password" name="passconf" placeholder="Repeat Password"  />
          
        </hr>
        <h2 class="h2-cards">Detalle de Pagos</h2>

                    <li>
                        <ul class="cards">
                            <li class="visa off">Visa</li>
                            <li class="visa_electron off">Visa Electron</li>
                            <li class="mastercard off">MasterCard</li>
                            <li class="maestro">Maestro</li>
                            <li class="discover off">Discover</li>
                        </ul>
                    </li>



                        <input type="text" name="card_number" id="card_number" placeholder="Numero Tarjeta" pattern=".{16,16}" required>

                        <input type="text" name="cvv" id="cvv" maxlength="3" placeholder="CVV" pattern=".{3,3}" required>

                        <input type="text" class="expiry_date" name="expiry_date" id="expiry_date" maxlength="5" placeholder="Vencimiento mm/yy" required>
                    
                        <input type="text" class="issue_date" name="issue_date" id="issue_date" maxlength="5" placeholder="Emisión mm/yy" required>

                        <input type="text" name="name_on_card" id="name_on_card" placeholder="Dueño Tarjeta" required>

                <input type="submit" name="submit" class="btn btn-sm btn-success">

          <p class="disclaimer">Su cuenta sera creada como Profesor Pro, el primer acceso será enviado a su cuenta de correo. El cargo por crear esta cuenta es de <strong>&cent;13000</strong></p>
        </form>
       </section>
      
    </div>

    <div id="signupProfe3" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="register-part">
        <p class="login-overlay">
          Registrarse en Prosystem
        </p>
        <form  action="controllers/regAction.php" method="post">
          <input class="form-control" type="hidden" name="role" placeholder="role" value="5"/>
          <input class="form-control" type="email" name="email" placeholder="Email" />
          <input class="form-control" type="password" name="password" placeholder="Password"  />
          <input class="form-control" type="password" name="passconf" placeholder="Repeat Password"  />
          
        </hr>
        <h2 class="h2-cards">Detalle de Pagos</h2>

                    <li>
                        <ul class="cards">
                            <li class="visa off">Visa</li>
                            <li class="visa_electron off">Visa Electron</li>
                            <li class="mastercard off">MasterCard</li>
                            <li class="maestro">Maestro</li>
                            <li class="discover off">Discover</li>
                        </ul>
                    </li>



                        <input type="text" name="card_number" id="card_number" placeholder="Numero Tarjeta" pattern=".{16,16}" required>

                        <input type="text" name="cvv" id="cvv" maxlength="3" placeholder="CVV" pattern=".{3,3}" required>

                        <input type="text" class="expiry_date" name="expiry_date" id="expiry_date" maxlength="5" placeholder="Vencimiento mm/yy" required>
                    
                        <input type="text" class="issue_date" name="issue_date" id="issue_date" maxlength="5" placeholder="Emisión mm/yy" required>

                        <input type="text" name="name_on_card" id="name_on_card" placeholder="Dueño Tarjeta" required>

                <input type="submit" name="submit" class="btn btn-sm btn-success">

          <p class="disclaimer">Su cuenta sera creada como Profesor Deluxe, el primer acceso será enviado a su cuenta de correo. El cargo por crear esta cuenta es de <strong>&cent;15000</strong></p>
        </form>
       </section>
      
    </div>

    <div id="terms-service" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="terms-of-service">
        <p class="p-terms">
          Terminos de Servicio
        </p>

          <p>Ultima actualización: 09 de Junio, 2014</p>

          <p> favor, lea estos términos y condiciones ("Términos", "Términos y Condiciones") antes de utilizar el sitio Prosystem (el "Servicio") operado por Prosystem, RL ("nosotros" o "nuestro" "equipo"). </p>

          <p> Su acceso y uso del Servicio está condicionado a la aceptación y cumplimiento de las presentes Condiciones. Estos Términos se aplican a todos los visitantes, usuarios y otras personas que accedan o usen el servicio. </p>

          <p> Al acceder o utilizar el Servicio, usted acepta que quedará vinculado por estas Condiciones. Si no está de acuerdo con alguna parte de los términos, entonces no puede acceder al Servicio. </p>

          <p> <strong> Cuentas </strong> </p>

          <p> Al crear una cuenta con nosotros, nos debe proporcionar información que sea precisa, completa y actualizada en todo momento. El no hacerlo constituye una violación de los Términos, que puede resultar en la terminación inmediata de su cuenta en nuestro servicio. </p>

          <p> Usted es responsable de salvaguardar la contraseña que utiliza para acceder al Servicio y para cualquier actividad o acciones bajo su contraseña, si su contraseña es con nuestro servicio o de un servicio de terceros. </p>

          <p> Usted se compromete a no revelar su contraseña a terceros. Usted debe notificarnos inmediatamente después de haber tenido conocimiento de cualquier violación de seguridad o uso no autorizado de su cuenta. </p>

          <p> <strong> Enlaces a otros sitios web </strong> </p>

          <p> Nuestro Servicio puede contener enlaces a sitios web de terceros o servicios que no son propiedad o están controladas por Prosystem. </p>

          <p> Prosystem no tiene control sobre, y no asume ninguna responsabilidad por el contenido, políticas de privacidad o prácticas de ningún sitio web o servicios de terceros. Además, usted reconoce y acepta que Prosystem no será responsable o estará obligado, directa o indirectamente, por cualquier daño o pérdida causada o supuestamente causada por o en conexión con el uso o la credibilidad en cualquier Contenido, bienes o servicios disponibles en oa través de ninguno de dichos sitios o servicios. </p>

          <p> fuertemente Le aconsejamos que lea los términos y condiciones y las políticas de privacidad de cualquier sitio web de terceros o servicios que usted visita. </p>

          <p> <strong> Terminación </strong> </p>

          <p> Podemos cancelar o suspender el acceso a nuestro servicio de forma inmediata, sin previo aviso o responsabilidad, por cualquier motivo, incluyendo, sin limitación, si usted viola los Términos. </p>

          <p> Todas las disposiciones de los Términos que por su naturaleza deberían sobrevivir a la terminación sobrevivirán la terminación, incluyendo, sin limitación, las disposiciones de propiedad, renuncias de garantía, indemnización y limitaciones de responsabilidad. </p>

          <p> Podemos cancelar o suspender su cuenta inmediatamente, sin previo aviso o responsabilidad, por cualquier motivo, incluyendo, sin limitación, si usted viola los Términos. </p>

          <p> A su terminación, su derecho a utilizar el Servicio cesará inmediatamente. Si desea cancelar su cuenta, usted puede simplemente dejar de utilizar el Servicio. </p>

          <p> Todas las disposiciones de los Términos que por su naturaleza deberían sobrevivir a la terminación sobrevivirán la terminación, incluyendo, sin limitación, las disposiciones de propiedad, renuncias de garantía, indemnización y limitaciones de responsabilidad. </p>

          <p> <strong> Ley de Gobierno </strong> </p>

          <p> Estos Términos se regirán e interpretarán de acuerdo con las leyes de Costa Rica, sin consideración a su conflicto de disposiciones legales y excluyendo la Convención de las Naciones Unidas sobre los Contratos de Compraventa Internacional de Mercaderías (CISG). </p>

          <p> Nuestra incapacidad para hacer cumplir cualquier derecho o disposición de estas Condiciones no se considerará una renuncia a esos derechos. Si alguna disposición de estos Términos es considerada inválida o inaplicable por un tribunal, las restantes provisiones de estos Términos seguirán en vigor. Estos Términos y Condiciones constituyen el acuerdo completo entre nosotros en relación con nuestro Servicio, y sustituyen y reemplazan cualquier acuerdo previo que podamos tener entre nosotros en relación con el Servicio. </p>

          <p> <strong> Cambios </strong> </p>

          <p> Nos reservamos el derecho, a nuestra sola discreción, de modificar o sustituir estas Condiciones en cualquier momento. Si la revisión es un material vamos a tratar de proporcionar por lo menos 30 días de antelación antes de las nuevas disposiciones entren en vigencia. Lo que constituye un cambio material será determinado a nuestra discreción. </p>

          <p> Al continuar accediendo o utilice nuestro servicio después de esas revisiones se hacen efectivas, usted acepta que quedará vinculado por los términos revisados. Si usted no acepta los nuevos términos, por favor, deje de utilizar el Servicio. </p>

          <p> <strong> Contáctenos </strong> </p>

          <p> Si usted tiene alguna pregunta acerca de estos Términos, por favor póngase en contacto con nosotros. </p>

                 </section>
    </div>

    <div id="privacy" class="overlay overlay-content">
  
      <button type="button" class="overlay-close">Cerrar</button>
      <section class="terms-of-service">
        <p class="p-terms">
          Politica de Privacidad
        </p>

            <p> Última actualización: 09 de junio 2014 </p>

            <p> Prosystem ("nosotros", o "nuestro equipo") opera el sitio web Prosystem ("Servicio"). </p>

            <p> Esta página le informa de nuestras políticas con respecto a la recopilación, uso y divulgación de información personal cuando usted utiliza nuestro servicio. </p>

            <p> No vamos a usar o compartir su información con nadie, excepto como se describe en esta Política de Privacidad. </p>

            <p> Utilizamos su información personal para proporcionar y mejorar el servicio. Al utilizar el Servicio, usted está de acuerdo con la recopilación y uso de información de acuerdo con esta política. Salvo que se defina de otra manera en esta Política de Privacidad, los términos utilizados en la presente Política de privacidad tienen los mismos significados que en nuestros Términos y Condiciones, accesible en Prosystem </p>

            <p> <strong> Recopilación y uso de </strong> </p>

            <p> Durante el uso de nuestro servicio, podemos pedirle que nos proporcione cierta información de identificación personal que se puede utilizar para ponerse en contacto o identificarlo. La información personal identificable puede incluir, pero no limitarse a, su nombre, número de teléfono y otra información ("Información Personal"). </p>

            <p> <strong> Registro de datos </strong> </p>

            <p> Recopilamos información que su navegador envía cada vez que visita nuestro Servicio ("Datos de Registro"). Este Registro de datos puede incluir información como el Protocolo de la computadora de Internet ("IP"), tipo de navegador, la versión del navegador, las páginas de nuestro servicio que usted visita, la fecha y hora de su visita, el tiempo dedicado a esas páginas y otros estadísticas. </p>

            <p> <strong> cookies </strong> </p>

            <p> Las cookies son ficheros con pequeña cantidad de datos, que pueden incluir un identificador único anónimo. Las cookies se envían a su navegador desde un sitio web y se almacenan en el disco duro de su ordenador. </p>

            <p> Utilizamos "cookies" para recoger información. Puede indicar a su navegador para rechazar todas las cookies o para indicar cuando se está enviando una cookie. Sin embargo, si usted no acepta cookies, es posible que no pueda utilizar algunas partes de nuestro Servicio. </p>

            <p> <strong> Proveedores de Servicio </strong> </p>

            <p> Nosotros podemos emplear a terceras empresas y particulares para facilitar nuestro servicio, para proporcionar el servicio en nuestro nombre, para realizar servicios relacionados con el servicio o para que nos ayuden en el análisis de cómo se utiliza nuestro servicio. </p>

            <p> Estos terceros tienen acceso a su información personal solamente para realizar estas tareas en nuestro nombre y están obligados a no revelar o utilizarlo para cualquier otro propósito. </p>

            <p> <strong> seguridad </strong> </p>

            <p> La seguridad de tu información personal es importante para nosotros, pero recuerda que ningún método de transmisión por Internet, o método de almacenamiento electrónico es 100% seguro. Si bien nos esforzamos por utilizar medios comercialmente aceptables para proteger su información personal, no podemos garantizar su absoluta seguridad. </p>

            <p> <strong> Enlaces a otros sitios </strong> </p>

            <p> Nuestro Servicio puede contener enlaces a otros sitios que no son operados por nosotros. Si hace clic en un vínculo de un tercero, se le dirigirá al sitio de dicho tercero. Le recomendamos que revise la política de privacidad de cada sitio que visita. </p>

            <p> No tenemos ningún control sobre, y no asumimos ninguna responsabilidad por el contenido, políticas o prácticas de privacidad de los sitios o servicios de terceros. </p>

            <p> <strong> Privacidad de los niños </strong> </p>

            <p> Nuestro servicio no se ocupa de ninguna persona menor de 13 años ("Niños"). </p>

            <p> No recopilamos a sabiendas información personal identificable de niños menores de 13 años. Si usted es un padre o tutor y que son conscientes de que sus hijos nos ha proporcionado información personal, póngase en contacto con nosotros. Si descubrimos que un Los niños menores de 13 años nos ha proporcionado información personal, eliminaremos dicha información de nuestros servidores inmediatamente. </p>

            <p> <strong> cambios a esta política de privacidad </strong> </p>

            <p> Podemos actualizar nuestra política de privacidad de vez en cuando. Le notificaremos de cualquier cambio mediante la publicación de la nueva política de privacidad en esta página. </p>

            <p> Se le aconseja que revise esta Política de Privacidad periódicamente para cualquier cambio. Cambios en esta Política de Privacidad es efectiva cuando se publican en esta página. </p>

            <p> <strong> Contáctenos </strong> </p>

            <p> Si tiene alguna pregunta sobre esta Política de Privacidad, por favor póngase en contacto con nosotros. </p>



      </section>
    </div>

 
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/classie.js"></script>
		<script src="js/cbpAnimatedHeader.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scrollReveal.js"></script>
    <script src="js/jquery.scrollTo.js" defer="defer"></script>
    <script src="js/jquery.nav.js" defer="defer"></script>
    <script src="js/imagesloaded.pkgd.min.js" defer="defer"></script>
    <script src="js/isotope.min.js" defer="defer"></script>
    <script src="js/jquery.magnific-popup.min.js" defer="defer"></script>
    <script src="js/jqBootstrapValidation.js" defer="defer"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.creditCardValidator.js"></script>
    <script src="js/validatecard.js"></script>

    <script src="js/less-1.6.1.min.js"></script>

    <script>

      $(document).ready(function(){

        isotope();
        signupOverlay();
        profe1Overlay();
        profe2Overlay();
        profe3Overlay();
        loginOverlay();
        termServiceOverlay();
        privacyOverlay();

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
  </body>
</html>
