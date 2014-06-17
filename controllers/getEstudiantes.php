<?php  
//allow sessions to be passed so we can see if the user is logged in
session_start();

//connect to the database so we can check, edit, or insert data to our users table
include('../model/dbconfig.php');

//include out functions file giving us access to the protect() function made earlier
include "../model/functions.php";

$query=mysql_query("SELECT * FROM users where role=2 ORDER BY role ASC") or die(mysql_error());

# Collect the results
while($obj = mysql_fetch_object($query)) {
    $arr[] = $obj;
}

# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;
?>
