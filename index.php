<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="style.css">
</head>
<body class="bg" style="min-height:600px">
<ul>
  <li><a href="index.php"  class="button">Home</a></li>
  <li><a href="upload.php" >File Upload</a></li>
  <li><a href="view.php" >View Files</a></li>
  <?php 
		if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
	{	
		echo '<li style="float: right;"><a href="logout.php" class="button" style="background-color:red" >Logout</a></li>';
	}
	else
	{
		echo '<li><a href="register.php" >Register</a></li>';
		echo '<li style="float: right;"><a href="login.php" class="button" style="background-color:red" >Login</a></li>';
	}
	?>
</ul>
<div style='margin-top:2%'>
	 <h1 style="text-align:center;color:red">Upload File to cloud</h1>
	 <p style="text-align:justify;color:blue">About the project:</p>
	 <p style="text-align:justify;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
	 <p style="text-align:justify;color:blue">Requirement:</p>
	<ol>
		<li>Server</li>
		<li>Text Editor</li>
		<li>Colud Computing</li>
	</ol>
</div>
	</body>
</html>