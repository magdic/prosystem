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
			$password = protect($_POST['password']);
			$passconf = protect($_POST['passconf']);

			//check if the password and confirm password match
							if($password != $passconf){
								//if not display error message
								echo "Pass incorrectas";
								// header("location: ../index.php?message=$msg");
							} else {

									$passmd5 = md5($password);


									mysql_query("UPDATE users SET password='$passmd5' WHERE id='$uid'");
									header("location: ../estudiante/perfil.php");
							}

		}

  

 		

?>