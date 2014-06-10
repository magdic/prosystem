<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('model/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "model/functions.php";

?>
<html>
	<head>
		<title>Prosystem | Logout</title>
        <script src="//localhost:35729/livereload.js"></script>

         <!-- basic styles -->

        <link href="css/bootstrap.css" rel="stylesheet" />

    	<link href="css/themelogged.css" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome.min.css" />



	</head>
	<body>
		<!-- <center><a href="./">Index</a></center> -->
		<?php

		//check if the login session does no exist
		if(!$_SESSION['uid']){
			//if it doesn't display an error message
			/*echo "<center>You need to be logged in to log out!</center>";*/
            echo "<div class='row'>
                     <div class='col-sm-4 col-sm-offset-4'>
                        <div class='alert alert-block alert-warning'>
                            <p>
                                <strong>
                                    <i class='icon-ok'></i>
                                </strong>
                                    You need to be logged in to log out!
                            </p>
                            <p>
                                <a href='./' class='btn btn-sm btn-warning btn-block'>Go to Index</a>
                            </p>
                        </div>
                    </div>
                </div>";
		}else{
			//if it does continue checking

			//update to set this users online field to the current time
			mysql_query("UPDATE `users` SET `online` = '".date('U')."' WHERE `id` = '".$_SESSION['uid']."'");

			//destroy all sessions canceling the login session
			session_destroy();

			//display success message
			/*echo "<center>You have successfully logged out!</center>";*/
            echo            "<div class='row'>
                                 <div class='col-sm-4 col-sm-offset-4'>
                                    <div class='alert alert-block alert-success'>
                                        <p>
                                            <strong>
                                                <i class='icon-ok'></i>
                                            </strong>
                                                Usted ha cerrado la sesion!
                                        </p>
                                        <p>
                                            <a href='./' class='btn btn-sm btn-success btn-block'>Ir al inicio de Prosystem</a>
                                        </p>
                                    </div>
                                </div>
                            </div>";
		}

		?>
	</body>
</html>
