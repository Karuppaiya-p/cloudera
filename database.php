<?php 
	$host="localhost";
	$username="root";
	$password="";
	$database="cloud_hosting";
	$conn= mysqli_connect($host,$username,$password,$database);
	if (mysqli_connect_errno())
	{
		die(mysqli_connect_error());
	}
	date_default_timezone_set('Asia/Kolkata');
?>
