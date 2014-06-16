<?php  
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../model/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../model/functions.php";


$uid = $_SESSION['uid'];

// echo $uid;die();

		//Check to see if the form has been submitted
		if(isset($_POST['submit'])){

			//protect and then add the posted data to variables
			// $username = protect($_POST['username']);
			$id = protect($_POST['id']);
			$name = protect($_POST['name']);
			$lastname = protect($_POST['lastname']);
			$zona = protect($_POST['zona']);
			$email = protect($_POST['email']);
			$telefonocasa = protect($_POST['telefonocasa']);
			$mobil = protect($_POST['mobil']);

		}


mysql_query("UPDATE users SET name='$name', lastname='$lastname', zona='$zona', email='$email', telefonocasa='$telefonocasa', mobil='$mobil' WHERE id='$uid'");
header("location: ../estudiante/perfil.php");
  

 		

?>