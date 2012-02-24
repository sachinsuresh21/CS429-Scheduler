<?php

//connect to our database
$username = "suresh_cs428";
$servername = "128.174.252.75";
$userpwd = "cs428";
$databasename = "suresh2_schedulerApp";

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
