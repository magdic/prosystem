<?php
		//allow sessions to be passed so we can see if the user is logged in
		session_start();

		//connect to the database so we can check, edit, or insert data to our users table
		include "../model/dbconfig.php";

		//include out functions file giving us access to the protect() function
		include "../model/functions.php";

		//Check to see if the form has been submitted
		if(isset($_POST['submit'])){

			//protect and then add the posted data to variables
			// $username = protect($_POST['username']);
			$password = protect($_POST['password']);
			$passconf = protect($_POST['passconf']);
			$email = protect($_POST['email']);
			$role = protect($_POST['role']);

			//check to see if any of the boxes were not filled in
			if(!$password || !$passconf || !$email){
				//if any weren't display the error message
				$msg =md5("Fill all");
				header("location: ../index.php?message=$msg");
			}
			// else{
				//if all were filled in continue checking

				//Check if the wanted username is more than 32 or less than 3 charcters long
				// if(strlen($username) > 32 || strlen($username) < 3){
				// 	//if it is display error message
				// 	$msg =md5("USer lenght");
				// 	header("location: ../index.php?message=$msg");
				// }

				// else{
					//if not continue checking

					// //select all the rows from out users table where the posted username matches the username stored
					// $res = mysql_query("SELECT * FROM `users` WHERE `username` = '".$username."'");
					// $num = mysql_num_rows($res);

					// //check if theres a match
					// if($num == 1){
					// 	//if yes the username is taken so display error message
					// 	$msg =md5("username taken");
					// 	header("location: ../index.php?message=$msg");
					// }

					else{
						//otherwise continue checking

						//check if the password is less than 5 or more than 32 characters long
						if(strlen($password) < 5 || strlen($password) > 32){
							//if it is display error message
							$msg =md5("Pass lenght");
							header("location: ../index.php?message=$msg");
						}else{
							//else continue checking

							//check if the password and confirm password match
							if($password != $passconf){
								//if not display error message
								$msg =md5("Pass not matches");
								header("location: ../index.php?message=$msg");
							}
							// else{
								//otherwise continue checking

								//Set the format we want to check out email address against
								// $checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@(thehang)+\\.net$/i";
								// $checkemailCM = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@(soup)+\\.com$/i";

								// $acceptedDomains = array('thehangar.cr', 'soup.com');
								// //check if the formats match
					   //          if(!in_array(substr($email, strrpos($email, '@') + 1))){
					   //          	//if not display error message
					   //          	$msg =md5("You are not member");
								// 	header("location: ../index.php?message=$msg");
					   //          }

					            else{
					            	//if they do, continue checking

					            	//select all rows from our users table where the emails match
					            	$res1 = mysql_query("SELECT * FROM `users` WHERE `email` = '".$email."'");
					            	$num1 = mysql_num_rows($res1);

					            	//if the number of matchs is 1
					            	if($num1 == 1){
					            		//the email address supplied is taken so display error message
					            		$msg =md5("The E-mail address you supplied is already taken!");
										header("location: ../index.php?message=$msg");
									}else{
										//finally, otherwise register there account

										//time of register (unix)
						            	$registerTime = date('U');

						            	//make a code for our activation key
						            	$code = md5($email).$registerTime;

						            	//insert the row into the database
										$res2 = mysql_query("INSERT INTO `users` (`password`, `email`, `rtime`, `role`) VALUES('".md5($password)."','".$email."','".$registerTime."','".$role."')");

										//send the email with an email containing the activation link to the supplied email address
										mail($email, $INFO['chatName'].
											'Gracias por Registrarse en Prosystem', "Gracias por registrarse en Prosystem, recibimos la notificacion de la creación de su cuenta mediante el correo electrónico ".$email.",\n\nDirijase al siguiente enlace para activar su cuenta!.\n\nhttp://localhost:8888/postmorten/activate.php?code=".$code,'From: noreply@prosystem-ucr.tk');

										//display the success message
										$msg =md5("You have successfully registered, please visit you inbox to activate your account!");
										header("location: ../index.php?message=$msg");
									}
								}
							// }
						}
					}
				// }
			// }
		}

		?>
