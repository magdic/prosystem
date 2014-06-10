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
		<title>Activation Page</title>
		

        <link href="css/bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/theme.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />



	</head>
	<body>
		<?php

		//echo md5('other');
		//get the code that is being checked and protect it before assigning it to a variable
		$code = protect($_GET['code']);

		//check if there was no code found
		if(!$code){
			//if not display error message
			echo "<center>Unfortunatly there was an error there!</center>";
		}else{
			//other wise continue the check

			//select all the rows where the accounts are not active
			$res = mysql_query("SELECT * FROM `users` WHERE active = '0'");

			//loop through this script for each row found not active
			while($row = mysql_fetch_assoc($res)){

				//echo $row['username'];die();
				//check if the code from the row in the database matches the one from the user
				if($code == md5($row['email']).$row['rtime']){
					//if it does then activate there account and display success message
					$res1 = mysql_query("UPDATE `users` SET `active` = '1' WHERE `id` = '".$row['id']."'");

                    echo "<div class='row'>
                               <div class='col-sm-6 col-sm-offset-3'>
                                  <div class='alert alert-success'>
                                      <button type='button' class='close' data-dismiss='alert'>
                                          <i class='icon-remove'></i>
                                      </button>
                                        <p>
                                            <strong><i class='icon-ok'></i></strong>
                                            You have successfully activated your account!
                                        </p>
                                  </div>
                               </div>
                          </div>";
				}
			}
		}

		?>
		</div>
	</body>
</html>
