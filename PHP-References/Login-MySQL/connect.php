<?php

//connect to our database
$username = "zhagui1_admin";
$servername = "localhost";
$userpwd = "cs410admin";
$databasename = "zhagui1_scheduler_db";

//attempt connection
$connect = mysql_connect($servername,$username,$userpwd);

if(!$connect)
	die('Couldnt connect to the database'.mysql_error());

//select our db	
$selectdb = mysql_select_db($databasename, $connect);

//attempt selection of database
if(!$selectdb)
{
	die("Couldnt select the database".mysql_error());
}
?>
