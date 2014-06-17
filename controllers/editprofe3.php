<?php  
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../model/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../model/functions.php";


$uid = $_SESSION['uid'];

		//Check to see if the form has been submitted
		if(isset($_POST['submit'])){

			//protect and then add the posted data to variables
			// $username = protect($_POST['username']);
			$name = protect($_POST['name']);
			$lastname = protect($_POST['lastname']);
			$zona = protect($_POST['zona']);
			$email = protect($_POST['email']);
			$telefonocasa = protect($_POST['telefonocasa']);
			$mobil = protect($_POST['mobil']);
			$facebook = protect($_POST['facebook']);
			$experiencia = protect($_POST['experiencia']);
			$materia1 = protect($_POST['materia1']);
			$materia2 = protect($_POST['materia2']);
			$materia3 = protect($_POST['materia3']);
			$materia4 = protect($_POST['materia4']);
			$materia5 = protect($_POST['materia5']);

		}


mysql_query("UPDATE users SET name='$name', lastname='$lastname', zona='$zona', email='$email', telefonocasa='$telefonocasa', mobil='$mobil', facebook='$facebook', experiencia='$experiencia', materia1='$materia1', materia2='$materia2', materia3='$materia3', materia4='$materia4', materia5='$materia5' WHERE id='$uid'");
header("location: ../profe3/perfil.php");
  

 		

?>